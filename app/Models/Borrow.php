<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $table = 'trx_borrows';
    protected $guarded = [
        'id'
    ];

    protected $with = ['member','staff'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function BorrowItem()
    {
        return $this->hasMany(BorrowItem::class);
    }

    

}