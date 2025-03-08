<?php

namespace App\Models\Main;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [
        'id'
    ];
    protected $attributes = [
        'image' => 'product-default.jpg'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
