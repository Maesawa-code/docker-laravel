<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomingPlan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'store_id',
        'product_id',
        'planned_date',
        'quantity',
        'weight',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
