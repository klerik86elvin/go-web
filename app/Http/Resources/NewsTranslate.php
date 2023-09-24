<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsTranslate extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->news_id,
            'title' => $this->title,
            'description' => $this->description,
            'viewCount' => $this->news->viewCount,
            'language' => $this->locale->name,
            'created_at' => $this->created_at
        ];
    }
}
