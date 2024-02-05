<?php

namespace Neon\Models\Statuses;

enum BasicStatus: string implements BasicInterface {
    case Active     = 'A';
    case Draft      = 'F';
    case Inactive   = 'I';
    case New        = 'N';

    public static function default()
    {
      return self::New;
    }
}