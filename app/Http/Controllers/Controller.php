<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * @OA\Info(
 *      title="API Challenge Softsul",
 *      version="1.0.0",
 * )
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $response;

    public function __construct()
    {
        $this->response = response()->json();
        $this->response->setStatusCode(204);
    }

}