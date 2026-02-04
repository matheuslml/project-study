<?php

use App\Models\Certificate;
use Illuminate\Database\Migrations\Migration;

class OfficialDiaryInserts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function up(): void
    {

        $certificates = [
            [
                'name' => 'Ramon Loureiro Plácido',
                'description' => 'Certificado Digital - A1',
                'registration' => '62662',
                'cpf' => '***.244.***-**',
                'position' => 'Chefe de Gabinete',
                'status' => 'PUBLISHED'
            ]
        ];

        foreach ($certificates as $certificate) {
            Certificate::firstOrCreate($certificate);
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
