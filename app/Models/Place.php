<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $table='place';

    protected $vlabel= [
        'name',
        'location',
        'desc',
        'img',
        'open_day',
        'open_time',
        'ticket_price',
    ];

    public function gallery() {
        return $this->hasMany(Galery::class);
    }
}
