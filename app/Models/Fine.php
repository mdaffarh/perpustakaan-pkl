<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;
    protected $table = 'trx_fines';
    protected $guarded = [
        'id'
    ];

    protected $with = [
        'borrow','member','return'
    ];

    public function borrow()
    {
        return $this->belongsTo(borrow::class);
    }
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    public function return()
    {
        return $this->belongsTo(Returns::class);
    }
    public function creator()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }

}