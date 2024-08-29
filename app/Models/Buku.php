<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $primaryKey = 'buku_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'buku_id',
        'buku_penulis_id',
        'buku_kategori_id',
        'buku_penerbit_id',
        'buku_rak_id',

        'buku_judul',
        'buku_isbn',
        'buku_thnterbit',
    ];
}
