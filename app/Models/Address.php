<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'number',
        'col',
        'cp',
        'city',
        'state',
        'country',
    ];

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function branch(){
        return $this->hasOne(Branch::class);
    }
}
