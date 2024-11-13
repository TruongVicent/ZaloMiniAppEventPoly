<?php

namespace App\Enum;

use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum TagetAudience: string implements HasLabel, HasIcon,HasColor
{
    case Teacher = 'Giảng viên';
    case Student = 'Sinh viên';


    public function getLabel(): string {
        return match ($this) {
            self::Teacher => 'Giảng viên',
            self::Student => 'Sinh viên',
        };
    }



    public function getIcon(): ?string {
        return match ($this) {
            self::Teacher => 'heroicon-m-user-circle',
            self::Student => 'heroicon-m-user-group',

        };
    }

    public function getColor(): ?string {
        return match ($this) {
            self::Teacher, self::Student => 'success',
        };
    }
}
