<?php

namespace App\Enums;

enum EndpointFrequency: int
{
    case ONE_MINUTE = 1 * 60;
    case FIVE_MINUTE = 5 * 60;
    case THIRTY_MINUTE = 30 * 60;
    case ONE_HOUR = 60 * 60;

    public function label(): string
    {
        return match ($this) {
          self::ONE_MINUTE => '1 minute',
          self::FIVE_MINUTE => '5 minutes',
          self::THIRTY_MINUTE => '30 minutes',
          self::ONE_HOUR => '1 hour',
        };
    }
}
