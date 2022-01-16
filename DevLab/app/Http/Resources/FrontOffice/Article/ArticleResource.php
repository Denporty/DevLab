<?php

namespace App\Http\Resources\FrontOffice\Article;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'localisation' => $this->localisation,
            'tag' => $this->tag,
            'department' => $this->department,
            'places' => $this->places,
            'description' => $this->description,
            'map' => $this->map,
            'active_service' => $this->active_service,
            'description_section' => $this->description_section,
            'section_title' => $this->section_title,
            'summary' => $this->summary,
            'start_date' => Carbon::createFromFormat('Y-m-d H:i:s', $this->start_date)->isoFormat('dddd D MMMM HH[h]mm'),
            'end_date' => Carbon::createFromFormat('Y-m-d H:i:s', $this->end_date)->isoFormat('dddd D MMMM HH[h]mm'),
            'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->isoFormat('dddd D MMMM HH[h]mm'),
            'updated_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->isoFormat('dddd D MMMM HH[h]mm'),
        ];
    }
}
