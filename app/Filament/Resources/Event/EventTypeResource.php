<?php

namespace App\Filament\Resources\Event;

use App\Filament\Resources\Event\EventTypeResource\Pages;
use App\Filament\Resources\Event\EventTypeResource\RelationManagers;
use App\Models\EventType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class EventTypeResource extends Resource
{
    protected static ?string $model = EventType::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $label = "Loại sự kiện";

    protected static ?string $navigationGroup = "Sự kiện";
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Tên loại sự kiện')
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->label('Trạng thái')
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Tên loại sự kiện'),
                ToggleColumn::make('status')
                    ->label('Trạng thái')
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
            'index' => Pages\ListEventTypes::route('/'),
            'create' => Pages\CreateEventType::route('/create'),
            'edit' => Pages\EditEventType::route('/{record}/edit'),
        ];
    }
}
