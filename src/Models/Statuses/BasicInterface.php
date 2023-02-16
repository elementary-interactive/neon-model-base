<?php

namespace Neon\Models\Statuses;

interface BasicInterface
{
    /** Get the default status's value.
     * 
     */
    public static function default(): string;
}