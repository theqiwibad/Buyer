<?php

namespace Buyer\utils;

class Utils
{
    public static function toHours(int $seconds) : float
    {
        return floor($seconds / 3600);
    }

    public static function toMinutes(int $seconds) : float
    {
        return floor(($seconds % 3600) / 60);
    }

    public static function toSeconds(int $seconds) : float
    {
        return min($seconds % 60, 60);
    }
}
