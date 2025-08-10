<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Enums\OrderStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Order;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa o retorno da view ao acessar a rota index de pedidos.
     */
    public function test_index_orders(): void
    {

        $response = $this->get('/orders');

        $response->assertStatus(200)->assertViewHas('orders')
            ->assertViewIs('orders.index');
    }

    /**
     * Testa o retorno por paginação de todos os pedidos para a tabela.
     */
    public function test_list_orders(): void
    {
        Order::factory()->count(5)->create();

        $response = $this->get('api/orders');

        $response->assertStatus(200)
            ->assertJsonCount(5);
    }

    /**
     * Testa o retorno correto de um simples pedido único.
     */
    public function test_get_single_order(): void
    {
        $order = Order::factory()->create();

        $response = $this->getJson("api/orders/{$order->id}");

        $response->assertStatus(200)->assertJsonFragment([
            'id' => $order->id,
            'customer_name' => $order->customer_name,
            'order_date' => $order->order_date->format('d/m/Y H:i:s'),
            'delivery_date' => $order->delivery_date->format('d/m/Y H:i:s'),
            'status' => $order->status->value,
        ]);
    }

    /**
     * Testa o retorno de um erro ao tentar acessar um pedido inexistente.
     */
    public function test_get_single_order_returns_404_for_non_existent_order(): void
    {
        $nonExistenId = 999999999999999;

        $response = $this->getJson("api/orders/{$nonExistenId}");

        $response->assertStatus(404)->assertJson([
            'message' => 'Não existe nenhum(a) order com este identificador.',
        ]);
    }

    /**
     * Testa a correta criação de um pedido.
     */
    public function test_create_order(): void
    {
        $response = $this->postJson("/api/orders", [
            'customer_name' => 'Sally',
            'order_date' => '2025-08-08 15:06:43',
            'delivery_date' => '2025-08-09 15:06:43',
            'status' => OrderStatus::PENDING->value,
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'customer_name' => 'Sally',
                'order_date' => '08/08/2025 15:06:43',
                'delivery_date' => '09/08/2025 15:06:43',
                'status' => OrderStatus::PENDING->value,
            ]);

        $this->assertDatabaseHas('orders', [
            'customer_name' => 'Sally'
        ]);
    }

    /**
     * Testa a correta atualização de um pedido.
     */
    public function test_update_order(): void
    {
        $order = Order::factory()->create();

        $response = $this->putJson("/api/orders/{$order->id}", [
            'customer_name' => 'Sally',
            'order_date' => '2025-08-08 15:06:43',
            'delivery_date' => '2025-08-09 15:06:43',
            'status' => OrderStatus::PENDING->value,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'customer_name' => 'Sally',
                'order_date' => '08/08/2025 15:06:43',
                'delivery_date' => '09/08/2025 15:06:43',
                'status' => OrderStatus::PENDING->value,
            ]);
    }

    /**
     * Testa o retorno de um erro ao tentar atualizar um pedido inexistente.
     */
    public function test_update_order_returns_404_for_non_existent_order(): void
    {
        $nonExistenId = 999999999999999;

        $response = $this->putJson("/api/orders/{$nonExistenId}", [
            'customer_name' => 'Sally',
            'order_date' => '2025-08-08 15:06:43',
            'delivery_date' => '2025-08-09 15:06:43',
            'status' => OrderStatus::PENDING->value,
        ]);

        $response->assertStatus(404)->assertJson([
            'message' => 'Não existe nenhum(a) order com este identificador.',
        ]);
    }

    /**
     * Testa a correta exclusão de um pedido.
     */
    public function test_delete_order(): void
    {
        $order = Order::factory()->create();

        $response = $this->deleteJson("/api/orders/{$order->id}");

        $response->assertStatus(204)->assertNoContent();
        $this->assertDatabaseMissing('orders', [
            'id' => $order->id,
        ]);
    }

    /**
     * Testa o retorno de um erro ao tentar acessar um pedido inexistente.
     */
    public function test_delete_order_returns_404_for_non_existent_order(): void
    {
        $nonExistenId = 999999999999999;

        $response = $this->deleteJson("api/orders/{$nonExistenId}");

        $response->assertStatus(404)->assertJson([
            'message' => 'Não existe nenhum(a) order com este identificador.',
        ]);
    }
}
