<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Concert extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'venue_id', 'ticket'];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}