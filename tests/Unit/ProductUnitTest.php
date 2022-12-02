<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;

class ProductUnitTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_new_product()
    {
        $this->withExceptionHandling();
        
        $user=User::userAdmin();
        
        $response = $this->actingAs($user)->post('/products',[
            'cod_prod' => '537',
            'name' => 'Sarah Sofia',
            'description' => 'Wolfff',
            'price' => 50.00,
        ]);

        $response->assertStatus(302);
    }
}
