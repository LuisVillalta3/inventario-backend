<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Provider extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'idProveedor' => $this->idProveedor,
            'nombre' => $this->nombre,
            'email' => $this->email,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'fax' => $this->fax,
        ];
    }
}
