<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Tag;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        $tags = [];
        foreach($this->tags as $one)
        {
            $tag = Tag::find($one->id);

            $translations = [];
            foreach($tag->translations as $translation)
                $translations[] = ['language_id'=>$translation->id, 'name'=>$translation->title];
            $tags[] = $translations;
        }

        return [
            'id'=>$this->id,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
            'deleted_at'=>$this->deleted_at,
            'tags'=> $tags,
            'translations' => $this->translations
        ];
    }
}
