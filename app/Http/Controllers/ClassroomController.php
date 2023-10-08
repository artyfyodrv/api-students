<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddClassroomRequest;
use App\Http\Requests\EditClassroomRequest;
use App\Http\Services\ClassroomService;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class ClassroomController extends ResponseController
{
    public function create(AddClassroomRequest $request): JsonResponse
    {
        try {
            $data = Classroom::query()->firstOrCreate([
                'name' => $request->validated('name'),
            ]);
        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка создания учебного класса', 400);
        }

        return $this->sendResponse($data);
    }

    public function update(EditClassroomRequest $request): JsonResponse
    {
        try {
            $data = Classroom::query()->find($request->id);
            $data->fill($request->validated());
            $data->save();
        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка обновления студента', 400);
        }

        return $this->sendResponse($data);
    }

    public function getAll(): JsonResponse
    {
        try {
            $data = Classroom::query()->get()->all();
        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка получения данных учебных классов', 400);
        }

        return $this->sendResponse($data);
    }

    public function getOneInfo(Request $request): JsonResponse
    {
        try {
            $data = ClassroomService::getInfo($request->id);
        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка получения данных учебного класса', 400);
        }

        return $this->sendResponse($data);
    }

    public function setSchedule(Request $request): JsonResponse
    {
        try {
            $data = ClassroomService::setSchedule($request->classroom_id, $request->lections_id, $request->orders);
        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка назначения учебного плана', 400);
        }

        return $this->sendResponse($data);
    }

    public function getSchedule(Request $request): JsonResponse
    {
        try {
            $data = ClassroomService::getSchedule($request->id);
        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка получения учебного плана класса', 400);
        }

        return $this->sendResponse($data);
    }

    public function delete(Request $request): JsonResponse
    {
        try {
            $data = Classroom::query()->findOrFail($request->id);
            Student::query()->where('classroom_id', $request->id)->update(['classroom_id' => null]);
            $data->delete();

        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка удаление учебного класса', 400);
        }

        return $this->sendResponse($data);
    }
}
