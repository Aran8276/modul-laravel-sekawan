<?php

namespace App\Models;

use App\Models\Rak;
use App\Models\Penulis;
use App\Models\Kategori;
use App\Models\Penerbit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'buku_urlgambar',
    ];

    protected static function imageUpload($id, $data)
    {
        $buku = self::find($id);

        if ($buku->buku_urlgambar) {
            Storage::delete($buku->buku_urlgambar);
        }

        if ($data) {
            $path = $data->store('public/buku_pictures');
            $buku->buku_urlgambar = $path;
        }

        $buku->save();
    }

    protected static function imageDelete($id)
    {
        $buku = self::find($id);

        if ($buku->buku_urlgambar) {
            Storage::delete($buku->buku_urlgambar);
        }
    }

    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'buku_penulis_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'buku_kategori_id');
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'buku_penerbit_id');
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class, 'buku_rak_id');
    }
}
