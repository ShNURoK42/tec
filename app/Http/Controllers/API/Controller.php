<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as BaseController;

/**
 * @OA\Info(
 *     description="Тестовое API",
 *     version="1.0.0",
 *     title="API СТО",
 *     @OA\Contact(
 *         email="test@example.com"
 *     ),
 *     @OA\SecurityScheme(
 *         securityScheme="sanctum",
 *         type="http",
 *         scheme="bearer"
 *     )
 * )
 * @OA\Post(
 *     path="/api/sanctum/token",
 *     tags={"auth"},
 *     summary="Токен авторизации",
 *     description="Получение токена авторизации Sanctum.",
 *     operationId="sanctum_token",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="application/json",
 *             @OA\Schema(
 *                 @OA\Property(
 *                     property="email",
 *                     type="string"
 *                 ),
 *                 example={"email": "test@example.com"}
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     )
 * )
 * @QA\Tag(
 *     name="auth"
 *     description="Авторизация"
 * )
 * @QA\Tag(
 *     name="employees"
 *     description="Работники"
 * )
 */
class Controller extends BaseController
{

}
