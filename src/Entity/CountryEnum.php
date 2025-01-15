<?php

declare(strict_types=1);

namespace App\Entity;

enum CountryEnum: string
{
    case GB = 'GB';
    case CZ = 'CZ';
    case FR = 'FR';
    case DE = 'DE';
    case AT = 'AT';
}
