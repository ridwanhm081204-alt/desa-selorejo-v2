<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukReview extends Model
{
    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
