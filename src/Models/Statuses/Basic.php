<?php

namespace Neon\Models\Statuses;

interface Basic
{
    /** The default stasus of all possible statuses.
     * 
     */
    protected $default;

    /** Get the default status's value.
     * 
     */
    public static function default(): string;
}