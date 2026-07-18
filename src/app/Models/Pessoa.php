<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = [
        "nome",
        "idade",
        "user_id",
    ];
    public function telefones()
    {
        return $this->hasMany(Telefone::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

