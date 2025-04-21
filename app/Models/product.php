<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Table name usually in lowercase

    protected $fillable = [
        'name',
        'description',
        'price',
    ];
}
