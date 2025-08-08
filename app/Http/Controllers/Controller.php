<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $response;

    public function __construct()
    {
        $this->response = response()->json();
        $this->response->setStatusCode(204);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|\Illuminate\Database\Eloquent\Model $model
     */
    public function validate($model, $message = "Nenhum registro encontrado!"): bool
    {
        if (is_null($model)) {

            $this->response->setData(["error" => $message])->setStatusCode(404);

            return false;
        }

        $this->response->setData($model)->setStatusCode(200);

        return true;
    }
}