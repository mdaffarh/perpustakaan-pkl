<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookDonation extends Model
{
    use HasFactory;
    protected $table = 'trx_book_donations';
    protected $guarded = [
        'id'
    ];

    protected $with = ['member'];
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}