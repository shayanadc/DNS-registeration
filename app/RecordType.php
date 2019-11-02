<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordType extends Model
{
    protected $guarded = ['created_at', 'updated_at'];
    protected $hidden = ["created_at", "updated_at"];

    public function createNewRecord($array){
        return static::create($array);
    }
    public function domain()
    {
        return $this->belongsTo('App\Domain');
    }
}
