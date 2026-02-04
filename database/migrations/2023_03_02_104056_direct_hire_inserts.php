<?php

use App\Models\DirectHireModality;
use App\Models\DirectHireSituations;
use Illuminate\Database\Migrations\Migration;

class DirectHireInserts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function up(): void
    {

        
        $modalities = [
            [   
                'title' => 'Dispensa'
            ],
            [   
                'title' => 'Inexigibilidade'
            ]
        ];

        foreach ($modalities as $modality) {
            DirectHireModality::firstOrCreate($modality);
        }

        $situations = [
            [   
                'title' => 'Aberto'
            ],
            [   
                'title' => 'Suspenso'
            ],
            [   
                'title' => 'Anulado'
            ],
            [   
                'title' => 'Revogado'
            ],
            [   
                'title' => 'Em Julgamento'
            ],
            [   
                'title' => 'Concluído'
            ],
            [   
                'title' => 'Homologado'
            ],
            [   
                'title' => 'Adiado'
            ],
            [   
                'title' => 'Deserta'
            ],
            [   
                'title' => 'Adjucado'
            ],
            [   
                'title' => 'Fracassada'
            ],
            [   
                'title' => 'Retificado'
            ],
            [   
                'title' => 'Ratificada'
            ],
            [   
                'title' => 'Cancelada'
            ]
        ];

        foreach ($situations as $situation) {
            DirectHireSituations::firstOrCreate($situation);
        }

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
    }
}
