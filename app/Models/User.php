<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Employee\Employee;
use App\Models\Main\Branch;
use App\Models\Main\Product;
use App\Models\Employee\Role;
use App\Models\Main\Category;
use App\Models\Main\Transaction;
use App\Models\Employee\Schedule;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id'
    ];
    protected $attributes = [
        'avatar' => 'user-profile-default.jpg',
        'ktp_image' => 'ktp-default.jpg',
        'npwp_image' => 'npwp-default.jpg'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
