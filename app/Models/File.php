<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Event;

class File extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'original_name',
        'path',
    ];

    /**
     * Relación al usuario que subió el archivo.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación al evento al que pertenece el archivo.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
