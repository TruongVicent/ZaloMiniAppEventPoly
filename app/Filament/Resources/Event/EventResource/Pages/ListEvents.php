<?php

namespace App\Filament\Resources\Event\EventResource\Pages;

use App\Filament\Imports\PreakerImporter;
use App\Filament\Resources\Event\EventResource;
use App\Helpers\Import\imPreaker;
use App\Models\Preaker;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Fieldset;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Helpers\NotificationHelper;


class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('import_district')
                ->label('Nhập diễn giả sự kiện')
                ->icon('heroicon-m-user-plus')
                ->form([
                    Fieldset::make('Nhập giáo viên từ Excel')
                        ->schema([
                            FileUpload::make('attachment')
                                ->required()
                                ->maxSize(10240)
                                ->acceptedFileTypes(['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                                ->label('Tìm hoặc kéo vào file Excel - Sử dụng mẫu Gian_vien.xlsx')
                                ->storeFiles(TRUE)
                                ->directory(config('thumbnail.directory',
                                    'projects'))

                        ])->columns(1),
                ])
                ->action(function ($data){
                    try{
                        $path = storage_path('app/public/projects/' . basename($data['attachment']));

//                        $path   = public_path('storage/' . $data['attachment']);
//                            dd(!file_exists($path));
                        // Kiểm tra xem tệp tin tồn tại
                        if (!file_exists($path)){
                            NotificationHelper::error('Tệp tin không tồn tại');
                            return;
                        }
                        $reader = IOFactory::createReader('Xlsx');
                        $reader->setReadDataOnly(TRUE);
                        $spreadsheet = $reader->load($path);
                        $sheet       = $spreadsheet->getActiveSheet();
                        $sheetData   = $sheet->toArray();

                        imPreaker::import($sheetData);
                    }catch (\Exception $exception){
                        NotificationHelper::error($exception->getMessage());
                    }
                }),
            Actions\CreateAction::make(),
        ];
    }
}
