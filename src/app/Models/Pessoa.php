<?php

namespace App\Models;


use App\Observers\PessoaObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nome
 * @property int $idade
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Telefone> $telefones
 * @property-read int|null $telefones_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pessoa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pessoa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pessoa query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pessoa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pessoa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pessoa whereIdade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pessoa whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pessoa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pessoa whereUserId($value)
 * @mixin \Eloquent
 */

#[ObservedBy(PessoaObserver::class)]
class Pessoa extends Model
{
    protected $fillable = [
        "nome",
        "idade",
        "user_id",
        "status",
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

