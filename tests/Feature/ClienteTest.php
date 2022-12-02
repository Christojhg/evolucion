<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\User;

class ClienteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_cliente()
    {
        $this->withExceptionHandling();
        
        $user=User::userAdmin();
        
        $response = $this->actingAs($user)->post('/clients',[
            'name' => 'christopher huaman',
            'doc_id' => '74894537',
            'doc_ruc' => '20505172419',
            'email' => 'christojhg@gmail.com',
            'address' => 'Lima peru',
            'phone' => '987678567',
        ]);

        $response->assertStatus(302);
    }
}
