<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'http_code', 'attempt_number'];
    protected $primaryKey = 'id';
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'check_date';
}
