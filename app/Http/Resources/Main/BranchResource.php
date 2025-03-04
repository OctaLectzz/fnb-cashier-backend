<?php

namespace App\Http\Resources\Main;

use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
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
            'branch_code' => $this->branch_code,
            'image' => $this->image,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'status' => $this->status,
            'roles' => $this->roles ? RoleResource::collection($this->roles) : ''
        ];
    }
}
