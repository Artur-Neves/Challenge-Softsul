<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * @OA\Info(
 * version="1.0.0",
 * title="API para o Desafio Técnico SoftSul",
 * description="Documentação da API RESTful desenvolvida como parte do processo seletivo para a vaga de Desenvolvedor Full Stack na SoftSul.",
 * @OA\Contact(
 * email="nevesdev.ti@gmail.com",
 * name="Artur Neves Almeida",
 * url="https://www.linkedin.com/in/artur-neves-dev/"
 * ),
 * @OA\License(
 * name="MIT License",
 * url="https://opensource.org/licenses/MIT"
 * )
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