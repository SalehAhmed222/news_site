<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'type'=>$this->type,
            'user_name'=>$this->data['user_name'],
            'post_name'=>$this->data['post_name'],
            'comment'=>$this->data['comment'],
            'post_slug'=>$this->data['post_slug'],
            'created_date'=>$this->created_at->diffForHumans(),

        ];
    }
}
