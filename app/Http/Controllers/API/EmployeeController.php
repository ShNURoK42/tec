<?php

namespace App\Http\Controllers\API;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Throwable;

class EmployeeController
{
    /**
     * @OA\Post(
     *     path="/api/employees/started_work",
     *     tags={"employee"},
     *     summary="Работник приступил к работе",
     *     description="Доступно только по авторизации.",
     *     operationId="started_work",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="employee_id",
     *                     type="integer"
     *                 ),
     *                 example={"employee_id": 1}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     )
     * )
     */
    public function started_work(Request $request)
    {
        $employee_id = $request->post('employee_id');
        $employee = Employee::find($employee_id);

        if (!$employee) {
            return response()->json([
                'message' => "Bad request"
            ], 400);
        }

        if ($employee->is_working_now === true) {
            return response()->json([
                'message' => "Bad request"
            ], 400);
        }

        try {
            DB::beginTransaction();
            $employee->is_working_now = true;
            $employee->work_records()->create(['started_work_at' => Carbon::now()]);
            $employee->save();
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => "Successful operation"
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/employees/finished_work",
     *     tags={"employee"},
     *     summary="Работник окончил работу",
     *     description="Доступно только по авторизации.",
     *     operationId="finished_work",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="employee_id",
     *                     type="integer"
     *                 ),
     *                 example={"employee_id": 1}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     )
     * )
     */
    public function finished_work(Request $request)
    {
        $employee_id = $request->post('employee_id');
        $employee = Employee::find($employee_id);

        if (!$employee) {
            return response()->json([
                'message' => "Bad request"
            ], 400);
        }

        if ($employee->is_working_now !== true) {
            return response()->json([
                'message' => "Bad request"
            ], 400);
        }

        try {
            DB::beginTransaction();
            $employee->is_working_now = false;
            $employee->work_records()->whereNull('finished_work_at')->update(['finished_work_at' => Carbon::now()]);
            $employee->save();
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'message' => "Successful operation"
        ], 200);
    }
}
