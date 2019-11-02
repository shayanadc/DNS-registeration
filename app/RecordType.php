<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordType extends Model
{
    protected $fillable=['content'];
    public function createNewRecord($array){
        return static::create($array);
    }
}
