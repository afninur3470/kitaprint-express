<?php

namespace App\Enums;

enum BusinessType: string
{
    case Percetakan      = 'percetakan';
    case DigitalPrinting = 'digital_printing';
    case Offset          = 'offset';
    case LargeFormat     = 'large_format';
    case Merchandise     = 'merchandise';

    public function label(): string
    {
        return match ($this) {
            self::Percetakan      => 'Percetakan Umum',
            self::DigitalPrinting => 'Digital Printing',
            self::Offset          => 'Offset Printing',
            self::LargeFormat     => 'Large Format',
            self::Merchandise     => 'Merchandise',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(fn ($c) => [$c->value => $c->label()])->all();
    }
}