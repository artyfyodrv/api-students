<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\Classroom;

class ClassroomService
{
    /** Привязка учебного плана к учебному классу */
    public static function setSchedule($classroomId, $lectionsIds, $orders)
    {
        $data = Classroom::query()->find($classroomId);

        foreach ($lectionsIds as $index => $lectionId) {
            $order = $orders[$index];

            $syncData[$lectionId] = ['order' => $order, 'is_active' => true];
            $data->lections()->sync($syncData);
        }

        return [
            'classroom_id' => $classroomId,
            'classroom_name' => $data->name,
            'lections' => $data->lections
        ];
    }

    public static function getSchedule($classroomId)
    {
        $data = Classroom::query()->find($classroomId);

        return [
            'classroom_id' => $data->id,
            'classroom_name' => $data->name,
            'lections' => $data->lections()->get(['lections.topic', 'lections.description'])
        ];
    }

    public static function getInfo($id)
    {
        $data = Classroom::query()->find($id);

        return [
            'classroom_id' => $data->id,
            'classroon_name' => $data->name,
            'students' => $data->students()->get(['id', 'name'])
        ];
    }
}
