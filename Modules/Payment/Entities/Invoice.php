<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	
	protected $table = 'invoices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'price', 'description', 'type', 'invoice_status', 'status', 'created_at', 'updated_at'
	];

	public function main_cols() {
		$row = $this->toArray();
		$row['type_name'] = \_::invoice_type_options($row['type']);
		$row['invoice_status_name'] = \_::invoice_status_options($row['invoice_status']);

		$columns = ['id', 'user_id', 'price', 'type', 'type_name', 'invoice_status', 'invoice_status_name', 'created_at', 'transaction'];

		$row = array_replace(array_flip($columns), $row);

		return array_intersect_key($row, array_flip($columns));
	}

	public function Transaction() {
		return $this->hasMany('\App\Transaction', 'invoice_id', 'id');
	}

}
