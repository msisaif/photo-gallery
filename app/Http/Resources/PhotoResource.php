<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->update([
            'views' => $this->views + 1
        ]);

        return [
            'id'        => (int) ($this->id),
            'link'      => (string) ($this->link ?? ''),
            'user'      => (string) ($this->user->name ?? ''),
            'downloads' => (int) ($this->downloads ?? 0),
            'views'     => (int) ($this->views ?? 0),
            'likes'     => (int) ($this->likes ?? 0),
            'tags'      => (string) ($this->tags ?? ''),
        ];
    }
}
