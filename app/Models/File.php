<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;   // ← importa User
use App\Models\Event;  // ← importa Event

class File extends Model
{
    // Si vas a crear también factories para File, agrega:
    // use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'original_name',
        'path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
