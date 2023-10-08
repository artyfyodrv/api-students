<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AddStudentRequest;
use App\Http\Requests\EditStudentRequest;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class StudentController extends ResponseController
{
    public function create(AddStudentRequest $request): JsonResponse
    {
        try {
            $data = Student::query()->firstOrCreate([
                'name' => $request->validated('name'),
                'email' => $request->validated('email')
            ]);
        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка создания студента', 400);
        }

        return $this->sendResponse($data);
    }

    public function update(EditStudentRequest $request): JsonResponse
    {
        try {
            $data = Student::query()->find($request->id);
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
            $data = Student::query()->get()->all();
        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка получения информации о студенте', 400);
        }

        return $this->sendResponse($data);
    }

    public function getOneInfo(Request $request): JsonResponse
    {
        try {
            $data = Student::with('classroom.lections')->find($request->id);
        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка получения информации о студенте', 400);
        }

        return $this->sendResponse($data);
    }

    public function delete(Request $request): JsonResponse
    {
        try {
            $data = Student::query()->find((int)$request->id);
            $data->delete();
        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка при удалении студента', 400);
        }

        return $this->sendResponse($data);
    }
}
