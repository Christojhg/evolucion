<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherDetail extends Model
{
    use HasFactory;

    protected $table = "voucher_detail";

    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class, 'id_prod')->withTrashed();
    }
}
