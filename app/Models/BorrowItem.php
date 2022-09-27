<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowItem extends Model
{
    use HasFactory;
    protected $table = 'borrow_item';
    protected $guarded = [
        'id'
    ];

    protected $with = ['book'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

}