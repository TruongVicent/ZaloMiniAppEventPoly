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
use Filament\Tables\Columns\TextColumn;




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
                Forms\Components\TextInput::make('name')
                    ->label('Tên dự án')
                    ->required(),
                Forms\Components\TextInput::make('members')
                    ->label('Số lượng thành viên')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                Forms\Components\TextInput::make('level')
                    ->label('Cấp độ')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
                Forms\Components\TextInput::make('progress')
                    ->label('Tiến độ')
                    ->required(),
                Forms\Components\DatePicker::make('star_date')
                    ->label('Thời gian bắt đầu')
                    ->minDate(today())
                    ->required()
                    ->reactive(),
                Forms\Components\DatePicker::make('end_date')
                    ->label('Thời gian kết thúc')
                    ->minDate(fn ($get) => $get('star_date') ?? today())
                    ->required()
                    ->rule('after_or_equal:star_date'),
                Forms\Components\RichEditor::make('content')
                    ->columnSpan('full')
                    ->label('Nội dung')
                    ->required(),
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->icon('heroicon-m-sparkles')
                    ->label('Tên dự án'),
                TextColumn::make('members')
                    ->label('Số lượng thành viên'),
                TextColumn::make('level')
                    ->label('Cấp độ'),
                TextColumn::make('progress')
                    ->label('Tiến độ'),
                TextColumn::make('star_date')
                    ->label('Bắt đầu'),
                TextColumn::make('end_date')
                    ->label('Kết thúc'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
