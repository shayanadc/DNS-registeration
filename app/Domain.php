<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
//    protected $casts = ['name' => 'string'];
    protected $fillable = ['name'];
    public function createNewDomain($array)
    {
            return static::create($array);
    }
}
