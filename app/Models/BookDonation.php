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

    public function creator()
    {
        return $this->belongsTo(Staff::class, 'staff_approved');
    }

    public function editor()
    {
        return $this->belongsTo(Staff::class, 'staffygngambil');
    }
}