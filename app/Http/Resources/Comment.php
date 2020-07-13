<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostItem;
class Comment extends JsonResource
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

            //only for Eloquent not for DB RAW
            'post'=> new PostItem($this->load('post')),

        ];
    }
}
