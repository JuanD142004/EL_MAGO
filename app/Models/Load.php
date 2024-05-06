<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Load
 *
 * @property $id
 * @property $date
 * @property $products_id
 * @property $amount
 * @property $routes_id
 * @property $truck_types_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Product $product
 * @property Route $route
 * @property TruckType $truckType
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Load extends Model
{
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'products_id', 'amount', 'routes_id', 'truck_types_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'products_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function route()
    {
        return $this->belongsTo(\App\Models\Route::class, 'routes_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function truckType()
    {
        return $this->belongsTo(\App\Models\TruckType::class, 'truck_types_id', 'id');
    }
    

}
