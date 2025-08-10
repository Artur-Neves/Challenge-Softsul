<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Yajra\DataTables\DataTables;

/**
 * @OA\Schema(
 *     schema="Order",
 *     type="object",
 *     title="Pedido",
 *     description="Representa um pedido",
 *     required={"id","customer_name","order_date","delivery_date","status","created_at","updated_at"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="customer_name", type="string", maxLength=255, example="Artur Neves"),
 *     @OA\Property(
 *         property="order_date",
 *         type="string",
 *         format="date-time",
 *         example="01/05/2025 12:12:12",
 *         description="Data e hora do pedido"
 *     ),
 *     @OA\Property(
 *         property="delivery_date",
 *         type="string",
 *         format="date-time",
 *         example="01/10/2025 10:30:00",
 *         description="Data e hora da entrega"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         enum={"pendente","entregue","cancelado"},
 *         example="pendente",
 *         description="Status do pedido"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-01-05 12:15:00"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-01-06 08:00:00"
 *     )
 * )

 * @OA\Schema(
 *     schema="OrderRequest",
 *     type="object",
 *     title="Requisição de Pedido",
 *     description="Dados necessários para criar ou atualizar um pedido",
 *     required={"customer_name","order_date","delivery_date","status"},
 *     @OA\Property(property="customer_name", type="string", maxLength=255, example="Artur Neves"),
 *     @OA\Property(
 *         property="order_date",
 *         type="string",
 *         format="date-time",
 *         example="2025-01-05 12:12:12",
 *         description="Formato obrigatório: Y-m-d H:i:s"
 *     ),
 *     @OA\Property(
 *         property="delivery_date",
 *         type="string",
 *         format="date-time",
 *         example="2025-01-10 15:30:00",
 *         description="Deve ser posterior a 'order_date'"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         enum={"pendente","entregue","cancelado"},
 *         example="pendente"
 *     )
 * )
 */

class OrderController extends Controller
{

    public function index()
    {
        return view('pages.orders.index');
    }

    public function getOrdersData()
    {
        return DataTables::of(Order::all())->make(true);
    }

    /**
     * @OA\Get(
     *     path="/api/orders/{id}",
     *     summary="Exibir um pedido pelo ID",
     *     tags={"Orders"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do pedido",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pedido encontrado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pedido não encontrado"
     *     )
     * )
     */
    public function show(Order $order)
    {
        return $this->response->setData($order)->setStatusCode(200);
    }

    /**
     * @OA\Post(
     *     path="/api/orders",
     *     summary="Cadastrar um novo pedido",
     *     tags={"Orders"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/OrderRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Pedido criado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação"
     *     )
     * )
     */
    public function store(OrderRequest $request)
    {
        $order = Order::create($request->validated());

        return $this->response->setData($order)->setStatusCode(201);
    }

    /**
     * @OA\Put(
     *     path="/api/orders/{id}",
     *     summary="Atualizar um pedido existente",
     *     tags={"Orders"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do pedido",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/OrderRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pedido atualizado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Order")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pedido não encontrado"
     *     )
     * )
     */
    public function update(Order $order, OrderRequest $request)
    {
        $order->update($request->validated());

        return $this->response->setData($order)->setStatusCode(200);
    }

    /**
     * @OA\Delete(
     *     path="/api/orders/{id}",
     *     summary="Excluir um pedido",
     *     tags={"Orders"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do pedido",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Pedido excluído com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pedido não encontrado"
     *     )
     * )
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return $this->response->setStatusCode(204);
    }
}
