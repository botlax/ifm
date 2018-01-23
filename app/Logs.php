<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'logs';
    protected $fillable = ['logs','log_date','emp_id'];
    public $timestamps = false;
    protected $dates = ['log_date'];

    public function admin(){
    	return $this->belongsTo('App\Admin','id','emp_id');
    }

    public function scopeSort($q){
        $q->orderBy('log_date','DESC');
    }
}
