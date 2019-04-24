<?php

namespace Modules\Test\Entities;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
	protected $table = 'tests';

    protected $fillable = ['col1', 'col2', 'created_at', 'updated_at'];
}
