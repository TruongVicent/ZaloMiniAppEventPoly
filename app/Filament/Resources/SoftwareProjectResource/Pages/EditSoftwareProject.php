<?php

namespace App\Filament\Resources\SoftwareProjectResource\Pages;

use App\Filament\Resources\SoftwareProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSoftwareProject extends EditRecord
{
    protected static string $resource = SoftwareProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
