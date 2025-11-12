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

    /**
     * Relasi untuk mengambil item (digunakan oleh AdminController)
     */
    public function items()
    {
        return $this->hasMany(Penyewaan::class, 'transaksi_id');
    }

    /**
     * Relasi untuk mengambil item (digunakan oleh PesananController)
     * Ini adalah alias untuk 'items'
     */
    public function penyewaan()
    {
        return $this->hasMany(Penyewaan::class, 'transaksi_id');
    }

    /**
     * Relasi untuk mengambil data user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}