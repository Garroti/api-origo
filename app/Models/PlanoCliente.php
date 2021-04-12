<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanoCliente extends Model
{

  protected $table = 'plano_cliente';

  protected $fillable = [
    'plano_id',
    'cliente_id',
  ];

  public function planos()
  {
    return $this->belongsToMany(Planos::class);
  }

  public function clientes()
  {
    return $this->belongsToMany(Clientes::class);
  }

}
