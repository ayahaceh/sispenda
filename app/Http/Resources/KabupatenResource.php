<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KabupatenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            "text" => $this->nama_kab,
            "id" => $this->kode_kab,
            "id_kab" => $this->id
        ]);
    }
}
