<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Filament\Resources\TicketResource;
use App\Models\Ticket;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $newStatus = Ticket::newStatus();
        $resolvedStatus = Ticket::resolvedStatus();

        return [
            'Tất cả' => Tab::make('Tất cả'),
            'Chưa hỗ trợ ('.$newStatus.')'=> Tab::make()->query(fn($query) => $query->where('status','new')),
            'Đã hỗ trợ ('.$resolvedStatus.')'=> Tab::make()->query(fn($query) => $query->where('status', 'resolved')),
        ];
    }

}
