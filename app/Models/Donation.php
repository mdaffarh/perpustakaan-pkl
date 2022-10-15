<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'trx_donations';
    protected $guarded = [
        'id'
    ];

    protected $with = ['member', 'bookDonation'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function bookDonation()
    {
    	return $this->hasMany(BookDonation::class);
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
