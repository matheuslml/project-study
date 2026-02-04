<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

ini_set('memory_limit', '512M');

class DiariosAntigosController extends Controller
{
    
    /**
     * Retorna os diários oficiais antigos com os arquivos associados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $diarios = DB::table('official_diaries')
                ->leftJoin('files', 'official_diaries.id', '=', 'files.id') // Associação com arquivos
                ->leftJoin('certificate_official_diary', 'official_diaries.id', '=', 'certificate_official_diary.official_diary_id') // Relacionamento diário-certificado
                ->leftJoin('certificates', 'certificate_official_diary.certificate_id', '=', 'certificates.id') // Certificado correspondente
                ->select(
                    'official_diaries.edition',
                    'official_diaries.extra_edition',
                    'official_diaries.published_at',
                    'files.url',
                    'certificates.name as certificates_name' // Nome do certificado
                )
                ->orderBy('official_diaries.edition', 'asc')
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => $diarios
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error'   => true,
                'message' => 'Erro ao recuperar diários oficiais antigos.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
