<?php

namespace App\Enums;

enum TaskPriorityEnum: int
{
    case High = 1;
    case Medium= 2;
    case Low = 3;

    public static function getArrayPriority()
    {
        return [
            'Cao' => self::High,
            'Trung Bình' => self::Medium,
            'Thấp' => self::Low,
        ];
    }

    public static function getNamePriority($value)
    {
        return array_search($value, [
            'Cao' => 1,
            'Trung Bình' => 2,
            'Thấp' => 3
        ], true);
    }
}
