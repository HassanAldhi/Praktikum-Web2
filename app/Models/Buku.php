<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;

    protected $tabel = 'bukus';
    protected $dates = ['tgl_terbit'];
    protected $fillable = [
        'filename',
        'filepath',
        'judul',
        'penulis',
        'harga',
        'tgl_terbit'
    ];

    public function galeri(): HasMany
    {
        return $this->hasMany(Galeri::class);
    }
}
