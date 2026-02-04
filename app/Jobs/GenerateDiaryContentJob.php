<?php

namespace App\Jobs;

use App\Actions\OfficialDiary\ParsePDFAction;
use App\Models\OfficialDiary;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateDiaryContentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        OfficialDiary::query()
            ->whereNull('content')
            ->each(fn($diary) => ParsePDFAction::dispatch($diary));
    }
}
