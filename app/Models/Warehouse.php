<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_user',
        'country',
        'city',
        'address',
    ];    

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
