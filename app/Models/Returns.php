<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    use HasFactory;

    protected $table = 'trx_returns';
    protected $guarded = [
        'id'
    ];

    protected $with = ['borrow'];

    public function borrow()
    {
        return $this->belongsTo(Borrow::class);
    }
}