<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CitaPendienteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'usuario' => new UserResource($this->whenLoaded('usuario')),
            'fecha' => $this->fecha ? $this->fecha->toFormattedDateString() : null,
            'hora' => optional($this->hora)->format('H:i:s'),
            'hora_fin' => $this->hora_fin,
        ];
    }
}
