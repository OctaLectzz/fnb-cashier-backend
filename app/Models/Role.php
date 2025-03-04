<?php

namespace App\Models;

use App\Models\Main\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
