<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $primaryKey = 'peminjaman_id';
    protected $index = 'peminjaman_user_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'peminjaman_id',
        'peminjaman_user_id',
        'peminjaman_tglpinjam',
        'peminjaman_tglkembali',
        'peminjaman_statuskembali',
        'peminjaman_note',
        'peminjaman_denda',
    ];

    public function user()
    {
        // Side effect from the original `User` model (Model, Foreign Field, Owner Field)
        return $this->belongsTo(User::class, 'peminjaman_user_id', 'user_id');
    }
}
