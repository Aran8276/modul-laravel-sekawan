<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // Kenapa kok nggak login? Karena: https://stackoverflow.com/questions/21603347/laravel-authattempt-will-not-persist-login
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'user_nama',
        'user_alamat',
        'user_username',
        'password',
        'user_email',
        'user_notelp',
        'user_level',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // WAJIB MENJADIKAN SESSION MENJADI STRING KARENA KOLUM `user_id` pada `user` adalah string / varchar
            // ASLINYA MENJADI bigint / autoincrement?
            'user_id' => 'string',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function register($data)
    {
        return self::create($data);
    }
}
