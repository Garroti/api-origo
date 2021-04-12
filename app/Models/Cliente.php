<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  protected $fillable = [
    'nome',
    'email',
    'telefone',
    'estado',
    'cidade',
    'dataNascimento'
  ];

  public function planos()
  {
    return $this->belongsToMany(Plano::class, 'plano_cliente', 'cliente_id', 'plano_id');
  }
}
