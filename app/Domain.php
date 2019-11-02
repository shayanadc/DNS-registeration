<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable = ['name'];

    public function createNewDomain($array)
    {
            return static::create($array);
    }
    public function records()
    {
        return $this->hasMany('App\RecordType');
    }
}
