<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'tb_books';
    protected $guarded = ['id'];

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }


}