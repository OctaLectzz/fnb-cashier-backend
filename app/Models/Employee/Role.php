<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'permissions' => 'array'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
