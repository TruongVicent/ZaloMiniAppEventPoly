<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SoftwareProjectResource\Pages;
use App\Filament\Resources\SoftwareProjectResource\RelationManagers;
use App\Models\SoftwareProject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SoftwareProjectResource extends Resource
{
    protected static ?string $model = SoftwareProject::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Dự án xưởng';
    protected static ?string $navigationGroup = 'Dự án xưởng';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSoftwareProjects::route('/'),
            'create' => Pages\CreateSoftwareProject::route('/create'),
            'edit' => Pages\EditSoftwareProject::route('/{record}/edit'),
        ];
    }
}
