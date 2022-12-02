<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class VoucherTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_crear_voucher()
    { 
        $user=User::userAdmin();
        
        $response = $this->actingAs($user)->post('/voucher',[
            "client_name"=> "1 | christopher huaman",
            "currency_voucher"=> "1",
            "product"=> [
                "Zapatillas nike l"
            ],
            "cantidad"=> [
                "1"
            ],
            "precio"=> [
                "100.00"
            ],
            "total"=> "100",
            "total_final"=> "100",
        ]);

        $response->assertStatus(302);

        
    }
}
