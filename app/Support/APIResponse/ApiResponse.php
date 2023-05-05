<?php

namespace App\Support\Services\APIResponse;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Http\JsonResponse executed()
 * @method static \Illuminate\Http\JsonResponse failed()
 * @method static \Illuminate\Http\JsonResponse success($body, int $code = 200, array $extra = [])
 * @method static \Illuminate\Http\JsonResponse error($body, int $code = 400, array $extra = [])
 * @method static \Illuminate\Http\JsonResponse base()
 *
 * @see \Codebase\API\Support\Services\APIResponse\JsonResponder
 */
class ApiResponse extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'api-responder';
    }
}
