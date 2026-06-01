<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappContact extends Model
{
    protected $fillable = ['product_id', 'product_name', 'phone', 'status'];

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault(['name' => 'Producto eliminado']);
    }
}
