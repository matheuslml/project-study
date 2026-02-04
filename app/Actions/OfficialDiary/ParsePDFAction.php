<?php

namespace App\Actions\OfficialDiary;

use App\Models\OfficialDiary;
use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Smalot\PdfParser\Parser;

class ParsePDFAction
{
    use AsAction;

    /**
     * @throws Exception
     */
    public function handle(OfficialDiary $diary): void
    {
        $parser = app(Parser::class);

        $file = $diary?->files?->first();
        if (!$file) {
            return;
        }
        $fullFile = storage_path("app/public/files/{$file->url}");
        $pdf = $parser->parseFile($fullFile);
        $content = preg_replace('/' . preg_quote('.', '/') . '+/u', '.', $pdf->getText());
        $diary->update(['content' => $content]);
    }

    public $jobTimeout = 60*10;
}
