<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
            'id' => $this->id,
            'content' => $this->content,
            'created_at_ts'=>$this->created_at->timestamp,
            'image_url'=>$this->image->url ?? '-',
            'count_of_comments'=>$this->comments->count()

//В каждом посте возвращать еще и количество комментариев к каждому посту в поле `count_of_comments`.

        ];
    }
}
