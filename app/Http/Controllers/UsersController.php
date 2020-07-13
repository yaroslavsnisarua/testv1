<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;

use App\Http\Resources\Comment as CommentResource;
use Illuminate\Support\Facades\DB;
class UsersController extends Controller
{




//showComments
public function showComments(Request $request) {


/*	
Создать роут, который принимает параметр user_id, и возвращает все комментарии (включая удаленные) соответствующего юзера, оставленные под постами в которых есть картинка. Сортировать по дате создания комментария по убыванию. Роут должен вернуть данные в формате JSON.
*/

if ($request->has('user_id')) {

	



$user = User::with(['commentsAll','commentsAll.post'])->findOrFail($request->user_id);
$commentsEloquent=$user->commentsAll()
			   ->whereHas('post', function ($q)  {
                            $q->whereNotNull('image_id');
                        })
			   ->orderBy('created_at','desc')
			   ->get();




$commentsDB= DB::table('comments')

     ->select(['comments.content','comments.id'])
     ->join('posts', 'posts.id', '=', 'comments.post_id')
     ->whereNotNull('posts.image_id')
     ->where('comments.commentator_id', $request->user_id)
     ->orderBy('posts.created_at','desc') //В ТЗ не было задания создавать даты для комментариев
     ->get();

/*$commentsDB2= DB::select( DB::raw("SELECT comments.content,comments.id FROM comments,posts WHERE posts.image_id != null and comments.commentator_id = :u and posts.id = comments.post_id order by posts.created_at desc"), [
   'u' => $request->user_id,
 ]);*/


/*
7.2*. В случае с запросом через Query Builder вывести внутри каждого комментария сам пост, полученный с помощью жадной загрузки. А сам пост должен содержать картинку, полученную ленивой загрузкой.
7.2.1***. В теле поста выводить еще и автора этого поста, если только он активный (active=true), в противном случае автор – null.

*/



return CommentResource::collection($commentsEloquent);
} else {
	return 'fail';
}





}



    public function index(Request $request) {


			$users = User::with(['posts','posts.comments','posts.image'])

			->where('active','true')

			->get();




//Добавить необязательный параметр запроса `posts_limit`, 
//при наличии которого возвращать только столько постов в поле `posts`, сколько задано в `posts_limit`
if ($request->has('posts_limit')) {
	$users->map(function ($query) use($request) {
            $query->setRelation('posts', $query->posts->take($request->posts_limit));
            return $query;
        });
}




$res = new UserCollection($users);


foreach ($res as $user) {


		$user->posts->sortBy(function($hackathon)
			{
			    return $hackathon->comments->count();
			});



}



return $res;



    }
}
