<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    protected $appends = ['sex_text'];
    protected $guarded = ['id'];

    public $sexs = [
        '0' => '男',
        '1' => '女'
    ];

    public function getSexTextAttribute($value){
    	return $this->sexs[$this->sex];
    }

    public function user(){
    	return $this->belongsTo('App\User', 'user_id');
    }
}
