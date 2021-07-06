<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use Sortable;

    protected $table = 'products';

    public $product_id;
    public $current_number;
    public $name;
    public $artikul_number;
    public $price_per_piece;
    public $pieces;
    public $package_price;
    public $status;
    public $state;

    protected $fillable = ['current_number', 'name', 'artikul_number', 'price_per_piece', 'pieces', 'package_price', 'status', 'state'];
    protected $sortable = ['current_number', 'name', 'artikul_number', 'price_per_piece', 'pieces', 'package_price', 'status', 'state'];

    public function history()
    {
        return $this->hasMany(History::class);
    }

    public function scopeName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    public function scopeStatus($query, $status)
    {
        return $query->whereIn('status', $status);
    }

    public function scopeState($query, $state)
    {
        return $query->whereIn('state', $state);
    }

    public static function scopeCount($query)
    {
        return \DB::table('products')->count();
    }

}
