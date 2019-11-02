<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordType extends Model
{
    protected $fillable=['domain_id','content'];
    public function createNewRecord($array){
        return static::create($array);
    }
    public function domain()
    {
        return $this->belongsTo('App\Domain');
    }
}
