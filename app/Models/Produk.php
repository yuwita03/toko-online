<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public $timestamps = true;
    protected $table = "produk";
    protected $guarded = ['id'];
    use HasFactory;
    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
