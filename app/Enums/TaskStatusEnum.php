<?php

namespace App\Enums;

enum TaskStatusEnum: int
{
    case New = 1;
    case In_Progress= 2;
    case Completed = 3;
    case On_Hold = 4;

    public static function getArrayStatus()
    {
        return [
            'Mới tạo' => self::New,
            'Đang làm' => self::In_Progress,
            'Hoàn thành' => self::Completed,
            'Tạm hoãn' => self::On_Hold,
        ];
    }

    public static function getNameStatus($value)
    {
        return array_search($value, [
            'Mới tạo' => 1,
            'Đang làm' => 2,
            'Hoàn thành' => 3,
            'Tạm hoãn' => 4,
        ], true);
    }
}
