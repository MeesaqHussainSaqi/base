<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'school_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'address',
        'user_type_id',
        'last_login_at',
        'status',
        'created_by',
        'deleted_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // A user belongs to a school
    // public function school()
    // {
    //     return $this->belongsTo(School::class);
    // }

    // A user has a user type (Principal, Teacher, etc.)
    // public function userType()
    // {
    //     return $this->belongsTo(UserType::class);
    // }

    // User who created this record
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    // User who deleted this record
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
