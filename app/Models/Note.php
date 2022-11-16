<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'Notes';

    protected $guarded = [];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'id_voucher');
    }
    
    public function voucher_type()
    {
        return $this->belongsTo(VoucherType::class, 'id_voucher_type');
    }

    public function voucher_status()
    {
        return $this->belongsTo(VoucherStatus::class, 'id_voucher_status');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'id_currency');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
