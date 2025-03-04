<?php

namespace App\Models\Main;

use App\Models\Role;
use App\Models\Employee\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];
    protected $attributes = [
        'image' => 'branch-default.jpg'
    ];

    public function roles()
    {
        return $this->hasMany(Role::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
