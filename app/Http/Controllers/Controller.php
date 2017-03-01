<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * @SWG\Swagger(
 *     schemes={"https","http"},
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Astro API",
 *         description="Astro API"
 *     ),
 *     basePath="/api",
 *     @SWG\Definition(
 *          definition="ErrorResponse",
 *          @SWG\Property(property="message", type="string"),
 *          @SWG\Property(property="code", type="integer", description="Exception code"),
 *          @SWG\Property(property="status_code", type="integer", description="HTTP status code"),
 *          @SWG\Property(
 *              property="errors",
 *              type="array",
 *              @SWG\Items(
 *                  type="array",
 *                  @SWG\Items(type="string")
 *              )
 *          )
 *     )
 * )
 */
class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
}
