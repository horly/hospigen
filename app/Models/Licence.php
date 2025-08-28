<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    //
    use HasFactory;
    protected $table = "licences";

    protected $fillable = [
        'cle_licence',
        'date_debut',
        'date_expiration',
        'type_licence'
    ];
}
