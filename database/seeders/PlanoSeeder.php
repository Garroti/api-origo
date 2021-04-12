<?php

namespace Database\Seeders;

use App\Models\Plano;
use Illuminate\Database\Seeder;

class PlanoSeeder extends Seeder
{

    const PLANOS = [
      [
        "nome"       =>    "Free",
        "valorMensal"      =>    0.00
      ],
      [
        "nome"       =>    "Basic",
        "valorMensal"      =>    100.00
      ],
      [
        "nome"       =>    "Plus",
        "valorMensal"      =>    187.00
      ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach (self::PLANOS as $plano) {
        Plano::create($plano);
      }
    }
}
