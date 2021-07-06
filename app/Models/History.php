<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class History extends Model
{
    use Sortable;

    protected $table = 'history';

    public $id;
    public $data;
    public $active;
    public $serial_number;
    public $timestamps = false;

    protected $fillable = ['product_id', 'data', 'created_at', 'serial_number', 'artikul_number'];
    protected $sortable = ['serial_number', 'created_at'];

    public function product()
    {
        return $this->hasOne('App\Models\Product');
    }

    public function historyDeactivate(Request $request)
    {
        $data = $request->all();

        History::where('id', $data['id'])->update(['active' => 0]);

        echo json_encode(['succ' => 'deactivated']);
    }

    public function scopeSerial($query, $serial_number)
    {
        return $query->where('serial_number', '=', $serial_number);
    }

    public function scopeArtikul($query, $artikul_number)
    {
        return $query->orWhere('artikul_number', '=', $artikul_number);
    }

}
