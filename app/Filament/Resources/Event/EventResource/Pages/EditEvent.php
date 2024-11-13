<?php

namespace App\Filament\Resources\Event\EventResource\Pages;

use App\Enum\TagetAudience;
use App\Filament\Resources\Event\EventResource;
use App\Models\EventType;
use App\Models\Preaker;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\Select;
use Filament\Forms;

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
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
              Select::make('status') // Thay 'end_time' bằng tên cột tương ứng trong cơ sở dữ liệu
                ->label('Trạng thái')
                    ->options([
                        'end' => 'Đã kết thúc',
                    ])
                    ->required(), // Bỏ hoặc thêm tùy theo yêu cầu

            ]);
    }
}
