<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    use HasFactory;

    protected $table = "notifications";

    protected $fillable = [
        'description',
        'link',
        'id_user',
    ];

    function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }

    public function read()
    {
        return $this->hasMany('App\Models\ReadNotif');
    }
}
