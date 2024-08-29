<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanDetail extends Model
{
    use HasFactory;
    protected $table = 'peminjaman_detail';
    protected $index = 'peminjaman_detail_buku_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'peminjaman_detail_peminjaman_id',
        'peminjaman_detail_buku_id',
    ];
}
