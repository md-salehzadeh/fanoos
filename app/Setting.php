<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table = 'settings';

    static protected $cache = [];

    static public function init()
    {
        $settings = [];
        foreach(self::all() as $key => $item)
            $settings[$item->name] = $item;
        self::setCache($settings);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'title', 'description', 'value', 'default', 'type', 'status', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];

	static public function get($name)
    {
    	return setting($name);
    }

    static public function setCache($settings)
    {
        self::$cache = $settings;
    }

    static public function getCache()
    {
        return self::$cache;
    }
}
