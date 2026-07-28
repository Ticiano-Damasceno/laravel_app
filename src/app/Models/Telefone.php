<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $numero
 * @property int $pessoa_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pessoa $pessoa
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Telefone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Telefone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Telefone query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Telefone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Telefone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Telefone whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Telefone wherePessoaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Telefone whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Telefone extends Model
{
    protected $fillable = [
        'numero','pessoa_id', 'tipo'
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
