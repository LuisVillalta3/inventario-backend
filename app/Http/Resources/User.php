<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
            [
                'id' => $this->id,
                'nombre' => $this->name,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'fecha_contratacion' => $this->fecha_contratacion,
                'dui' => $this->dui,
                'email' => $this->email,
            ];
    }
}
