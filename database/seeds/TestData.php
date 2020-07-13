<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Post;
use App\Image;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class TestData extends Seeder
{
    /**
     * Run the database seeds.
     *

composer dump-autoload
php artisan db:seed

     * @return void
     */
    public function run()
    {
       

//создадим 50 пользователей
       for ($i = 0 ; $i <= 50 ; $i++) {

    	$user = User::create([
    	 'name' 	=> Str::random(10),
         'email' 	=> Str::random(10).'@example.com',
         'password' => Hash::make('password'),
        ]);

		$img = Image::create([
			'url'  =>  Str::random(10)
		]);

//для каждого пользователя создадим 10 постов
for ($n = 0 ; $n <= 10 ; $n++) {
		$post = $user->posts()->create([
			'image_id'	=>$img->id,
			'content'	=>Str::random(256)

		]);


//для каждого поста создадим по 10 комментариев
		for ($k = 0 ; $k <= 10 ; $k++) {
		$post->comments()->create([

		'commentator_id'=>$user->id,
		'content'		=>Str::random(256)

		]);

//для каждого поста создадим по 5 удалённых комментариев
		for ($z = 0 ; $z <= 10 ; $z++) {
		$comment = $post->comments()->create([

		'commentator_id'=>$user->id,
		'content'		=>Str::random(256)

		]);
		$comment->delete();


	}




}







       }



//для чётных итераций пользователей
if ($i % 2 == 0) {

$user->update([

	'active'=>'false'

]);

}



    }
}
}