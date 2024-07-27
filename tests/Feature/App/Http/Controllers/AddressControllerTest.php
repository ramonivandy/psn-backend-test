<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Address;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_an_address()
    {
        $customer = Customer::factory()->create();
        $addressData = Address::factory()->make(['customer_id' => $customer->id])->toArray();

        $response = $this->post('/api/address', $addressData);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => $addressData
            ]);

        $this->assertDatabaseHas('addresses', $addressData);
    }

    /** @test */
    public function it_can_update_an_address()
    {
        $customer = Customer::factory()->create();
        $address = Address::factory()->create(['customer_id' => $customer->id]);

        $updatedData = Address::factory()->make(['customer_id' => $customer->id])->toArray();

        $response = $this->put('/api/address/' . $address->id, $updatedData);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => $updatedData
            ]);

        $this->assertDatabaseHas('addresses', $updatedData);
    }

    /** @test */
    public function it_can_delete_an_address()
    {
        $customer = Customer::factory()->create();
        $address = Address::factory()->create(['customer_id' => $customer->id]);

        $response = $this->delete('/api/address/' . $address->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('addresses', ['id' => $address->id]);
    }
}
