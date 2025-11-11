<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'user_id',
        'nama',
        'alamat',
        'metode',
        'tanggal_sewa',
        'tanggal_kembali',
        'total',
        'status'
    ];

    public function penyewaan()
    {
        return $this->hasMany(Penyewaan::class, 'transaksi_id');
    }
}