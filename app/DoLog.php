<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoLog extends Model
{
	protected $fillable = [
        'user_id', 'log_title', 'log_type', 'log_url', 'log_ip', 'log_data', 
    ];
}
