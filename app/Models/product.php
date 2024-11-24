<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'selling_price',
        'purchase_price',
        'stock',
        'foto',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
