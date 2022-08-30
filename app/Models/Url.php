<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Url extends Model {
    protected $fillable = ['url', 'frequency', 'quantity'];
    protected $primaryKey = 'id';
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'updated_date';

    public function checks()
    {
        return $this->hasMany(Check::class);
    }
}