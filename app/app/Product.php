<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_name', 'weight', 'image_path'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
