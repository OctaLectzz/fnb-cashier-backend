<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Main\Branch;
use App\Models\Main\Product;
use App\Models\Employee\Role;
use App\Models\Main\Category;
use App\Models\Main\Transaction;
use App\Models\Employee\Employee;
use App\Models\Employee\Schedule;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];
    protected $attributes = [
        'avatar' => 'user-profile-default.jpg',
        'ktp_image' => 'ktp-default.jpg',
        'npwp_image' => 'npwp-default.jpg'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed'
        ];
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function roles()
    {
        return $this->hasMany(Role::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
