<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemasukanM extends Model
{
    use HasFactory;
    protected $table = 'pemasukan';
    protected $primaryKey = 'idpemasukan';
    protected $connection = 'mysql';
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(barangM::class, 'idbarang','idbarang');
    }
}
