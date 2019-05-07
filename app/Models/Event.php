<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'streamer_id'
    ];

    public function streamer()
    {
        return $this->belongsTo(Streamer::class);
    }
}
