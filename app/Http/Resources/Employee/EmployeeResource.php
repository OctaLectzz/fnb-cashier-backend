<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'nip' => $this->nip,
            'avatar' => $this->avatar,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'position' => $this->position,
            'pin' => $this->pin,
            'branch_id' => $this->branch_id,
            'schedule_id' => $this->schedule_id,
            'ktp' => $this->ktp,
            'ktp_image' => $this->ktp_image,
            'dob' => $this->dob,
            'gender' => $this->gender,
            'domicile' => $this->domicile,
            'address' => $this->address,
            'employment_status' => $this->employment_status,
            'date_joined' => $this->date_joined,
            'end_date' => $this->end_date,
            'bpjs_tk_number' => $this->bpjs_tk_number,
            'bpjs_tk_card' => $this->bpjs_tk_card,
            'bpjs_health_number' => $this->bpjs_health_number,
            'bpjs_health_card' => $this->bpjs_health_card,
            'bank_name' => $this->bank_name,
            'bank_account_number' => $this->bank_account_number,
            'account_holder_name' => $this->account_holder_name,
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }
}
