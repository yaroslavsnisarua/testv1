<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostItem extends JsonResource
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
            'author'=>$this->author()
                            ->where('active','true')
                            ->first()->name ?? null,

            'content' => $this->content,
            'created_at_ts'=>$this->created_at->timestamp,

        ];
    }
}
