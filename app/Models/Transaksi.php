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
    'no_hp', // <--- TAMBAHKAN INI
    'alamat',
    'metode',
    'tanggal_sewa',
    'tanggal_kembali',
    'total',
    'status',
    'bukti_transfer',
];


    public function items()
    {
        return $this->hasMany(Penyewaan::class, 'transaksi_id');
    }

    public function penyewaan()
    {
        return $this->hasMany(Penyewaan::class, 'transaksi_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}