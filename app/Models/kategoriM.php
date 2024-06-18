<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriM extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';
    protected $connection = 'mysql';
    protected $guarded = [];

    public function barang()
    {
        return $this->hasOne(barangM::class, 'idkategori','idkategori');
    }
}
