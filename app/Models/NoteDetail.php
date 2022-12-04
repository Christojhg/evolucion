<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteDetail extends Model
{
    use HasFactory;
    
    protected $table = 'notes_detail';

    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class, 'id_prod')->withTrashed();
    }
}
