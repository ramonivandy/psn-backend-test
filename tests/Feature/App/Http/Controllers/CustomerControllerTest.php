<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Customer;
use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Create test data
        Customer::factory()->count(10)->create()->each(function ($customer) {
            $customer->address()->saveMany(Address::factory()->count(3)->make());
        });
    }

    /** @test */
    public function it_can_list_customers()
    {
        $response = $this->get('/api/customers');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'name',
                        'gender',
                        'phone_number',
                        'image',
                        'email',
                        'address' => [
                            '*' => [
                                'id',
                                'customer_id',
                                'address',
                                'district',
                                'city',
                                'province',
                                'postal_code',
                            ]
                        ]
                    ]
                ],
                'meta' => [
                    'current_page',
                    'last_page',
                    'per_page',
                    'total',
                ]
            ]);
    }

    /** @test */
    public function it_can_show_a_customer()
    {
        $customer = Customer::first();

        $response = $this->get('/api/customers/' . $customer->id);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => [
                    'id' => $customer->id,
                    'title' => $customer->title,
                    'name' => $customer->name,
                    'gender' => $customer->gender,
                    'phone_number' => $customer->phone_number,
                    'image' => $customer->image,
                    'email' => $customer->email,
                ]
            ]);
    }

    /** @test */
    public function it_can_create_a_customer()
    {
        $customerData = [
            'title' => 'Mr.',
            'name' => 'John Doe',
            'gender' => 'male',
            'phone_number' => '1234567890',
            'image' => 'path/to/image.jpg',
            'email' => 'john@example.com',
        ];

        $response = $this->post('/api/customers', $customerData);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data' => $customerData
            ]);

        $this->assertDatabaseHas('customers', $customerData);
    }

    /** @test */
    public function it_can_update_a_customer()
    {
        $customer = Customer::first();

        $updatedData = [
            'title' => 'Dr.',
            'name' => 'Jane Doe',
            'gender' => 'female',
            'phone_number' => '0987654321',
            'image' => 'path/to/new_image.jpg',
            'email' => 'jane@example.com',
        ];

        $response = $this->put('/api/customers/' . $customer->id, $updatedData);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => $updatedData
            ]);

        $this->assertDatabaseHas('customers', $updatedData);
    }

    /** @test */
    public function it_can_delete_a_customer()
    {
        $customer = Customer::first();

        $response = $this->delete('/api/customers/' . $customer->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
    }
}
