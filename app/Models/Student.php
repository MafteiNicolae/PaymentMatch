<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function tutors(){
        return $this->hasMany(Tutor::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }
}
