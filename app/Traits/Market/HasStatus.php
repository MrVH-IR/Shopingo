<?php

namespace App\Traits\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

trait HasStatus
{
    public function changeStatus(Model $model): JsonResponse
    {
        $model->status = !$model->status;

        $result = $model->save();

        return response()->json([
            'status' => $result,
            'checked' => (bool) $model->status,
        ]);
    }
}
