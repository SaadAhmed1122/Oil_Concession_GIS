<?php

namespace App\Filament\Resources\ConcessionResource\Pages;

use App\Filament\Resources\ConcessionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConcessions extends ListRecords
{
    protected static string $resource = ConcessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
