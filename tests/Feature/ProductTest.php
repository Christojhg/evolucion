<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_index_producto()
    {

        $this->withExceptionHandling();
        
        $producto = Product::factory(4)->create();
        
        $user=User::userAdmin();

        $response = $this->actingAs($user)->get('/products');
        
        $response->assertViewIs('products.index');
        $response->assertViewHas('products',$producto);
        
    }
}
