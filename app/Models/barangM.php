<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barangM extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'idbarang';
    protected $connection = 'mysql';
    protected $guarded = [];

    public function pemasukan()
    {
        return $this->hasOne(pemasukanM::class, 'idbarang','idbarang');
    }

    public function kategori()
    {
        return $this->belongsTo(kategoriM::class, 'idkategori','idkategori');
    }
}
