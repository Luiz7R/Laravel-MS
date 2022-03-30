<?php

namespace Tests\Feature;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_create_product()
    {
        $user = User::factory()->create();

        $credentials = [
            'email' => $user->email,
            'password' => 'password'
       ];

       $this->post(route('msLogin'), $credentials);

       $product = Product::factory()->create();

       $data = $product->only(['name', 'price', 'user_id', 'category_id']);

       $response = $this->post(route('postProduct'), $data);

       $response->assertStatus(302);
    }
    
   /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_delete_product()
    {
        $user = User::factory()->create();

        $credentials = [
            'email' => $user->email,
            'password' => 'password'
       ];

       $this->post(route('msLogin'), $credentials);
       
       $data = [
            'name' => 'Test Product',
            'price' => '1777',
            'user_id' => $user->id,
            'category_id' => 1,
       ]; 

       $product = Product::create($data);

       $response = $this->delete(route('deleteProduct', $product->id));

       $response->assertRedirect(route('msHome'));

       $this->assertDatabaseMissing('products', [
         'id' => $product->id
       ]);

    }

    
    public function test_user_can_update_product()
    {
        $user = User::factory()->create();

        $credentials = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $this->post(route('msLogin'), $credentials);

        $data = [
            'name' => ' Test Product x',
            'price' => '1777',
            'user_id' => $user->id,
            'category_id' => 1,
        ];

        $product = Product::create($data);

        $dataUpload = [
            'name' => 'Updated Product',
            'price' => '1770',
            'category_id' => $product->category_id
        ];

        // print_r($product->category_id);
        $response = $this->put(route('updateProduct', $product->id), $dataUpload);

        $response->assertOk();
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product',
            'price' => '1770'
        ]);
    }
        
}
