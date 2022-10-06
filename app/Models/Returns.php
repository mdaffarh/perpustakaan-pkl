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

    protected $with = ['borrow','creator','editor'];

    public function borrow()
    {
        return $this->belongsTo(Borrow::class);
    }

    public function creator()
    {
        return $this->belongsTo(Staff::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(Staff::class, 'updated_by');
    }
}