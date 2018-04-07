<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class App extends Model
{
    use SoftDeletes;
    
    protected $guarded = ['id'];
    protected $append = ['status_text'];

    public $statusList = [
        '0'=>'失效',
        '1'=>'生效'
    ];

    public function getStatusText($value){
        return $this->$statusList[$this->status];
    }
}
