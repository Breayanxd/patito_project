<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

     protected $fillable = [
        'name',
        'type',
        'phone',
        'email',
        'manager',
        'status',
        'address_id',
    ];
    
    public function address(){
        return $this->belongsTo(Address::class);
    }
}
