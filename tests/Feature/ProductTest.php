<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Enums\ProductStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa o retorno da view ao acessar a rota index de produtos.
     */
    public function test_index_products(): void
    {

        $response = $this->get('/products');

        $response->assertStatus(200)->assertViewHas('products')
            ->assertViewIs('products.index');
    }

    /**
     * Testa o retorno por paginação de todos os produtos para a tabela.
     */
    public function test_list_products(): void
    {
        Product::factory()->count(5)->create();

        $response = $this->get('api/products');

        $response->assertStatus(200)
            ->assertJsonCount(5);
    }

    /**
     * Testa o retorno correto de um simples produto único.
     */
    public function test_get_single_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->getJson("api/products/{$product->id}");

        $response->assertStatus(200)->assertJsonFragment([
            'id' => $product->id,
            'user_name' => $product->user_name,
            'order_date' => $product->order_date->format('d/m/Y H:i:s'),
            'delivery_date' => $product->delivery_date->format('d/m/Y H:i:s'),
            'status' => $product->status->value,
        ]);
    }

     /**
     * Testa o retorno de um erro ao tentar acessar um produto inexistente.
     */
    public function test_get_single_product_returns_404_for_non_existent_product(): void
    {
        $nonExistenId = 999999999999999;

        $response = $this->getJson("api/products/{$nonExistenId}");

        $response->assertStatus(404)->assertJson([
            'message' => 'Não existe nenhum(a) product com este identificador.',
        ]);
    }

    /**
     * Testa a correta criação de um produto.
     */
    public function test_create_product(): void
    {
        $response = $this->postJson("/api/products", [
            'user_name' => 'Sally',
            'order_date' => '2025-08-08 15:06:43',
            'delivery_date' => '2025-08-09 15:06:43',
            'status' => ProductStatus::PENDING->value,
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'user_name' => 'Sally',
                'order_date' => '08/08/2025 15:06:43',
                'delivery_date' => '09/08/2025 15:06:43',
                'status' => ProductStatus::PENDING->value,
            ]);

        $this->assertDatabaseHas('products', [
            'user_name' => 'Sally'
        ]);
    }

    /**
     * Testa a correta atualização de um produto.
     */
    public function test_update_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->putJson("/api/products/{$product->id}", [
            'user_name' => 'Sally',
            'order_date' => '2025-08-08 15:06:43',
            'delivery_date' => '2025-08-09 15:06:43',
            'status' => ProductStatus::PENDING->value,
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'user_name' => 'Sally',
                'order_date' => '08/08/2025 15:06:43',
                'delivery_date' => '09/08/2025 15:06:43',
                'status' => ProductStatus::PENDING->value,
            ]);
    }

         /**
     * Testa o retorno de um erro ao tentar atualizar um produto inexistente.
     */
    public function test_update_product_returns_404_for_non_existent_product(): void
    {
        $nonExistenId = 999999999999999;

        $response = $this->putJson("/api/products/{$nonExistenId}", [
            'user_name' => 'Sally',
            'order_date' => '2025-08-08 15:06:43',
            'delivery_date' => '2025-08-09 15:06:43',
            'status' => ProductStatus::PENDING->value,
        ]);

        $response->assertStatus(404)->assertJson([
            'message' => 'Não existe nenhum(a) product com este identificador.',
        ]);
    }

    /**
     * Testa a correta exclusão de um produto.
     */
    public function test_delete_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(204)->assertNoContent();
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

         /**
     * Testa o retorno de um erro ao tentar acessar um produto inexistente.
     */
    public function test_delete_product_returns_404_for_non_existent_product(): void
    {
        $nonExistenId = 999999999999999;

        $response = $this->deleteJson("api/products/{$nonExistenId}");

        $response->assertStatus(404)->assertJson([
            'message' => 'Não existe nenhum(a) product com este identificador.',
        ]);
    }
}
