<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model {

    protected $fillable = ["comment", "user", "idVideo"];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }

    public function getUserName()
    {
        return $this->belongsTo(User::class, 'user')->value('name');
    }


    public function video()
    {
        return $this->belongsTo(Video::class, 'idVideo');
    }

}
