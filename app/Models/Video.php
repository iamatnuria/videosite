<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model {

    use HasFactory;

    protected $fillable
        = [
            'title',
            'cont',
            'desc',
            'mini',
            'user',
            'visitas'
        ];

    public function users()
    {
        return $this
            ->belongsTo(User::class, 'user');
    }

    public function getUserName()
    {
        return $this->belongsTo(User::class, 'user')->value('name');
    }
}
