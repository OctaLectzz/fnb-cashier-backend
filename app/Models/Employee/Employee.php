<?php

namespace App\Models\Employee;

use App\Models\User;
use App\Models\Main\Branch;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasApiTokens, SoftDeletes;

    protected $guarded = ['id'];
    protected $attributes = [
        'avatar' => 'employee-profile-default.jpg'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
