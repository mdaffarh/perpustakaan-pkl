<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'tb_stocks';
    protected $guarded = [
        'id'
    ];

    public function book()
    {
    	return $this->belongsTo(Book::class);
    }
}