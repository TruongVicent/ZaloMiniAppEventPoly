<?php

namespace App\Filament\Resources\Event;

use App\Filament\Resources\Event\EventResource\Pages;
use App\Filament\Resources\Event\EventResource\RelationManagers;
use App\Models\Event;
use App\Models\EventType;
use App\Models\Preaker;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use App\Enum\TagetAudience;
use Filament\Infolists\Components\ImageEntry;


class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $label = "Sự kiện";

    protected static ?string $navigationGroup = "Sự kiện";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->columnSpan('full')
                    ->label('Ảnh sự kiện')
                    ->image()
                    ->imageEditor()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Tên sự kiện')
                    ->required(),
                Forms\Components\Select::make('event_type_id')
                    ->relationship( 'EventType','name', function ($query){
                        return $query->where('status',1);
                    })
                    ->options(EventType::where('status',1)->pluck('name', 'id'))
                    ->searchable()
                    ->label('Loại sự kiện')
                    ->required(),
                Forms\Components\Select::make('taget_audience')
                    ->options(TagetAudience::class)
                    ->label('Đối tượng hướng đến')
                    ->required(),
                Forms\Components\Select::make('Preaker')
                    ->multiple()
                    ->relationship('Preaker','name')
                    ->options(Preaker::all()->pluck('name','id'))
                    ->label('Chọn diễn giả')
                    ->required(),
                Forms\Components\RichEditor::make('content')
                    ->columnSpan('full')
                    ->label('Nội dung')
                    ->required(),
                Forms\Components\DateTimePicker::make('start_time')
                    ->label('Thời gian bắt đầu')
                    ->minDate(now())
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->label('Nhập địa chỉ sự kiện')
                    ->required(),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                ImageEntry::make('image')
                    ->columnSpan('full')
                    ->label('Ảnh sự kiện'),
                TextEntry::make('name')
                    ->label('Tên sự kiện'),
                TextEntry::make('EventType.name')
                    ->label('Loại sự kiện'),
                TextEntry::make('start_time')
                    ->label('Ngày giờ bắt đầu'),
                TextEntry::make('Preaker.name')
                    ->label('Diễn giả'),
                TextEntry::make('taget_audience')
                    ->label('Đối tượng hướng đến'),
                TextEntry::make('address')
                    ->label('Địa chỉ sự kiện'),
                TextEntry::make('status')
                    ->default(fn($record) => $record->status ?? 'Chưa bắt đầu')
                    ->label('Trạng thái'),
                TextEntry::make('content')
                    ->html()
                    ->label('Nội dung'),


            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->icon('heroicon-m-sparkles')
                    ->label('Tên sự kiện'),
                TextColumn::make('EventType.name')
                    ->label('Loại sự kiện'),
                TextColumn::make('start_time')
                    ->label('Bắt đầu'),
                TextColumn::make('taget_audience')
                    ->label('Đối tượng'),

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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
