<?php

namespace App\Http\Resources;

use App\Enums\EndpointFrequency;
use Illuminate\Http\Resources\Json\JsonResource;

class EndpointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        return [
          'id' =>$this->id,
          'location' => $this->location,
          'frequency_label' => EndpointFrequency::from($this->frequency)->label(),
          'frequency_value' => EndpointFrequency::from($this->frequency)->value,
          'latest_check' => CheckResource::make($this->check),
        ];
    }
}
