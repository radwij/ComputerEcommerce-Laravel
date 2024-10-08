<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Everything but id is inputted by user and allowed to be sent to database
    protected $guarded = [
        'id',
    ];

    // relationship to category and an easier way to access category from Product
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
