<?php

namespace App\Filament\Resources\Event\EventTypeResource\Pages;

use App\Filament\Resources\Event\EventTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEventType extends CreateRecord
{
    protected static string $resource = EventTypeResource::class;
}
