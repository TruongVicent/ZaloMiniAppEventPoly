<?php

namespace App\Helpers;

use Filament\Notifications\Notification;

class NotificationHelper
{

    /**
     * @param string $message
     *
     * @return void
     */
    public static function success(string $message = 'Thành công!'): void
    {
        Notification::make()
            ->title($message)
            ->icon('heroicon-o-document-text')
            ->iconColor('success')
            ->send();
    }

    /**
     * @param string $message
     *
     * @return void
     */
    public static function error(string $message = 'Đã có lỗi xảy ra'): void
    {
        Notification::make()
            ->title($message)
            ->icon('heroicon-o-document-text')
            ->iconColor('danger')
            ->send();
    }

    /**
     * @param string $message
     *
     * @return void
     */
    public static function warning(string $message = 'Cảnh báo'): void
    {
        Notification::make()
            ->title($message)
            ->icon('heroicon-o-document-text')
            ->iconColor('warning')
            ->send();
    }

}
