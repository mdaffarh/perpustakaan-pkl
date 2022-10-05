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

    protected $with = ['member','creator','editor'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function creator()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(Staff::class, 'updated_by');
    }

    public function borrowItem()
    {
        return $this->hasMany(BorrowItem::class);
    }

    public function fines()
    {
        return $this->hasOne(Fine::class);
    }

    public function return()
    {
        return $this->hasOne(Returns::class);
    }

    


    

}