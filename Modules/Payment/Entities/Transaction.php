<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	
	protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'trace_number', 'trans_status', 'type', 'adapter', 'status', 'created_at', 'updated_at'
	];

	public function main_cols() {
		$row = $this->toArray();
		$row['trans_status_name'] = \_::trans_status_options($row['trans_status']);

		$columns = ['id', 'invoice_id', 'trace_number', 'trans_status', 'type', 'created_at'];

		$row = array_replace(array_flip($columns), $row);

		return array_intersect_key($row, array_flip($columns));
	}

	public function Invoice() {
		return $this->belongsTo('\App\Invoice', 'invoice_id', 'id');
	}

}
