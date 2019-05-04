<?php

namespace Modules\Module\Entities;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	protected $table = 'modules';
	
    protected $fillable = ['name', 'title', 'description', 'version', 'release_date', 'dependencies', 'author_name', 'author_email', 'active', 'created_at', 'updated_at'];
}
