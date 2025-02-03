<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
    protected $attributes = [
        'pin' => '123456'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
