<?php

namespace Neon\Models\Statuses;

enum BasicStatus: string implements BasicInterface {
    case Active     = 'A';
    case Inactive   = 'I';
    case New        = 'N';

    public static function default(): string {
      return BasicStatus::New->value;
    }
}