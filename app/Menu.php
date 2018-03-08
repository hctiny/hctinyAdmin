<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
	use SoftDeletes;

    protected $guarded = ['id'];
    protected $appends = ['show_text'];

    public $showTypes = [
    	'0' => '隐藏',
        '1' => '显示'
    ];

    public function parent(){
    	return $this->belongsTo(self::class, 'parent_id');
    }

    public function getShowTextAttribute($value){
    	return $this->showTypes[$this->is_show];
    }
}
