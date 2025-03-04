<?php

namespace App\Models\Employee;

use App\Models\Main\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];
    protected $attributes = [
        'avatar' => 'employee-profile-default.jpg',
        'ktp_image' => 'ktp-default.jpg',
        'bpjs_tk_card' => 'bpjstk-default.jpg',
        'bpjs_health_card' => 'bpjshealth-default.jpg'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
