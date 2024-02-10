<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incoming extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function shouldImport()
    {
        return strtolower($this->type) === 'incasare';
    }


    public function invoices(){
        return $this->belongsToMany(Invoice::class)->withPivot('suma');
    }
}
