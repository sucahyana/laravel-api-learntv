<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StreamDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'number'=>$this->number,
            'title'=>$this->title,
            'code_id'=>$this->code_id,
            'name'=>$this->name,
            'category'=>$this->category,
            'link'=>$this->link,
            'thumbanail'=>asset('storage/thumbnails/' . $this->thumbnail),
        ];
    }
}
