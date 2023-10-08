<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddLectionRequest;
use App\Http\Requests\EditLectionRequest;
use App\Models\Lection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class LectionController extends ResponseController
{
    public function create(AddLectionRequest $request): JsonResponse
    {
        try {
            $data = Lection::query()->firstOrCreate([
                'topic' => $request->validated('topic'),
                'description' => $request->validated('description')
            ]);
        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка при создании лекции',400);
        }

        return $this->sendResponse($data);
    }

    public function update(EditLectionRequest $request): JsonResponse
    {
        try {
            $data = Lection::query()->find($request->id);
            $data->fill($request->validated());
            $data->save();
        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка обновления лекции', 400);
        }

        return $this->sendResponse($data);
    }

    public function getOneInfo(Request $request): JsonResponse
    {
        try {
            $data = Lection::with('classrooms.lections')->find($request->id);
        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка получения данных учебного класса', 400);
        }

        return $this->sendResponse($data);
    }

    public function delete(Request $request): JsonResponse
    {
        try {
            $data = Lection::query()->findOrFail($request->id);
            $data->delete();

        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка удаления лекции', 400);
        }

        return $this->sendResponse($data);
    }

    public function getAll(): JsonResponse
    {
        try {
            $data = Lection::query()->get()->all();
        } catch (Throwable $t) {
            Log::error($t->getMessage() . ' ' . __FILE__ . ' ' . __LINE__);
            return $this->sendError('Ошибка получения данных лекции', 400);
        }

        return $this->sendResponse($data);
    }

}
