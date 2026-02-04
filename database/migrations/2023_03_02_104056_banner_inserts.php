<?php

use App\Models\BannerType;
use Illuminate\Database\Migrations\Migration;

class BannerInserts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function up(): void
    {

        $banner_types = [
            [
                'title' => 'Ouvidoria',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'FAQs',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'Projetos',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'Notícias',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'Despesas',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'Receitas',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'Legislação',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'Licitação',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'Contratos',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'Contratação Direta',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'Equipe',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'Sobre',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'Galeria',
                'status' => 'PUBLISHED'
            ],
            [
                'title' => 'Diário Oficial',
                'status' => 'PUBLISHED'
            ]
        ];

        foreach ($banner_types as $type) {
            BannerType::firstOrCreate($type);
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
