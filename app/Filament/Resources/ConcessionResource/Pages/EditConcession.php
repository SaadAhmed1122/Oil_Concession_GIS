<?php

namespace App\Filament\Resources\ConcessionResource\Pages;

use App\Filament\Resources\ConcessionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditConcession extends EditRecord
{
    protected static string $resource = ConcessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
