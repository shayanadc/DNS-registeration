<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{

    protected $hidden = ["created_at", "updated_at"];

    protected $casts = [
        'approved' => 'boolean',
        'user_id' => 'integer'
    ];
    protected $fillable = ['name', 'approved','user_id'];

    public function createNewDomain($array)
    {
        return static::create($array);
    }

    public function records()
    {
        return $this->hasMany('App\RecordType');
    }

    public function toApproved()
    {
        $this->update(['approved' => true]);
    }
    public function scopeWaiting($query)
    {
        return $query->where('approved',false);
    }
    public function scopeApproved($query)
    {
        return $query->where('approved',true);
    }
}
