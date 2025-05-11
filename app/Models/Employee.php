<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address_id',
        'area_or_department',
        'position',
        'branch_id',
        'date_entry',
        'status',
    ];

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
}
