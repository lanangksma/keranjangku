<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * @var false|mixed|string
     */
    protected $fillable = [
        'title',
        'price',
        'description',
        'category',
        'image',
        'count',
    ];

}
