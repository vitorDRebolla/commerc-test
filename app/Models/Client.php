<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome', 'email', 'telefone', 'data_nascimento', 'endereco', 'complemento', 'bairro', 'cep'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
