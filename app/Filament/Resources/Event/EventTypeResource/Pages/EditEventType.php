<?php

namespace App\Filament\Resources\Event\EventTypeResource\Pages;

use App\Filament\Resources\Event\EventTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventType extends EditRecord
{
    protected static string $resource = EventTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
