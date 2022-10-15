<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryBook extends Model
{
    protected $table = 'category_book';
    protected $guarded = [
        'id'
    ];

    protected $with = ['bookDonation'];

    public function bookDonation()
    {
        return $this->hasMany(BookDonation::class, 'kategori');
    }

}
