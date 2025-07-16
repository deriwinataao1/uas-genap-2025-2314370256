<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_code', 'user_id', 'product_id', 'nama_penerima', 'negara', 'provinsi', 'kota', 'alamat_jalan',
        'kode_pos', 'telepon', 'email', 'catatan', 'pembayaran', 'status',
        'quantity', 'total_harga'
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function product() {
        return $this->belongsTo(Product::class);
    }
    
    
}
