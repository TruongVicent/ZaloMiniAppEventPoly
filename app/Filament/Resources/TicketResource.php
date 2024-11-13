<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Mail\SupportEmail;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Mail;


class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Quản lý hỗ trợ sinh viên';

    protected static ?string $label = 'Hỗ trợ sinh viên';

    protected static ?string $recordTitleAttribute = 'name_student';

    public static function getGloballySearchableAttributes(): array
    {
        return ['name_student', 'code_student'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('name_student')
                    ->label('Tên sinh viên'),
                TextEntry::make('code_student')
                    ->label('Mã số sinh viên'),
                TextEntry::make('email')
                    ->label('Email sinh viên'),
                TextEntry::make('content_support')
                    ->label('Vẫn đề cần hỗ trợ'),
                TextEntry::make('StatusLable')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Chưa hỗ trợ' => 'danger',
                        'Đã hỗ trợ' => 'success',
                    })
                    ->label('Trạng thái'),
                TextEntry::make('created_at')
                    ->label('Ngày sinh viên gửi hỗ trợ'),
                TextEntry::make('content_support')
                    ->html()
                    ->label('Vấn đề cần hỗ trợ'),
                TextEntry::make('supported_at')
                    ->label('Ngày đã hỗ trợ'),
                TextEntry::make('who_support')
                    ->label('Người đã hỗ trợ'),

            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_student')
                    ->icon('heroicon-m-user')
                    ->searchable()
                    ->label('Tên sinh viên'),
                TextColumn::make('code_student')
                    ->searchable()
                    ->label('Mã sinh viên'),
                Tables\Columns\SelectColumn::make('status')
                    ->options([
                        'new' => 'Chưa hỗ trợ',
                        'resolved' => 'Đã hỗ trợ',
                    ])
                    ->label('Trạng thái'),
                TextColumn::make('content_support')
                    ->limit(10)
                    ->label('Vấn đề cần hỗ trợ')
            ])->defaultSort('created_at','desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Hỗ trợ')
                    ->label('Hỗ trợ')
                    ->color('danger')
                    ->form([
                        Forms\Components\Section::make('Thông tin cần hỗ trợ')
                            ->schema([
                                Forms\Components\Placeholder::make('Nội dung cần hỗ trợ :')
                                    ->content(fn($record): string => $record->content_support),
                            ]),
                        Forms\Components\Section::make('Hỗ trợ')
                            ->schema([
                                Forms\Components\RichEditor::make('problem_support')
                                    ->label('Nhập nội dung hỗ trợ')
                            ])
                    ])
                    ->action(function ($record, $data) {
                        $record->problem_support = strip_tags($data['problem_support']);
                        $record->supported_at = now();
                        $record->who_support = auth()->user()->name;
                        $record->status = 'resolved';
                        Mail::to($record->email)->send(new SupportEmail($record->name_student, $record->code_student, $record->content_support, $record->created_at,
                            $record->who_support,
                            $record->problem_support,
                            $record->supported_at));
                        $record->save();

                        Notification::make()
                            ->title('Hỗ trợ thành công!!')
                            ->success()
                            ->send();

                    })
                    ->modalHeading('Hỗ trợ sinh viên')
                    ->modal()
                    ->hidden(fn($record) => $record->status == 'resolved'),
//                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),


        ];
    }
}
