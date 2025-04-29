<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Request;
use App\Http\Resources\Main\BranchResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
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
            'user_id' => $this->user_id,
            'employee_id' => $this->employee_id,
            'branch_id' => $this->branch_id,
            'date' => $this->date,

            // Entry details
            'entry_time' => $this->entry_time,
            'entry_location' => $this->entry_location,
            'entry_photo' => $this->entry_photo,
            'entry_status' => $this->entry_status,
            'late_minutes' => $this->late_minutes,
            'late_reason' => $this->late_reason,

            // Exit details
            'exit_time' => $this->exit_time,
            'exit_location' => $this->exit_location,
            'exit_photo' => $this->exit_photo,
            'exit_status' => $this->exit_status,
            'early_leave_minutes' => $this->early_leave_minutes,
            'early_leave_reason' => $this->early_leave_reason,

            'status' => $this->status,
            'verified_by' => $this->verified_by,
            'verified_by_employee' => new EmployeeResource($this->verifiedBy),
            'employee' => new EmployeeResource($this->employee),
            'branch' => new BranchResource($this->branch),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
