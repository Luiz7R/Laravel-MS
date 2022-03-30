<?php

namespace Tests\Feature;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_create_category()
    {
        $user = User::factory()->create();

        $credentials = [
            'email' => $user->email,
            'password' => 'password'
       ];

       $this->post(route('msLogin'), $credentials);

       $category = Categorie::factory()->create();

       $data = $category->only(['category_name', 'user_id']);

       $response = $this->post(route('postCategory'), $data);

       $response->assertStatus(302);
    }
    
   /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_delete_category()
    {
        $user = User::factory()->create();

        $credentials = [
            'email' => $user->email,
            'password' => 'password'
       ];

       $this->post(route('msLogin'), $credentials);
       
       $data = [
            'category_name' => 'Test Category',
            'user_id' => $user->id,
       ]; 

       $category = Categorie::create($data);

       $response = $this->delete(route('deleteCategory', $category->id));

       $response->assertOk();

       $this->assertDatabaseMissing('products', [
         'id' => $category->id
       ]);

    }

    
    public function test_user_can_update_category()
    {
        $user = User::factory()->create();

        $credentials = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $this->post(route('msLogin'), $credentials);

        $data = [
            'category_name' => ' Test Category x',
            'user_id' => $user->id,
        ];

        $category = Categorie::create($data);

        $dataUpload = [
            'category_name' => 'Updated Category',
            'id' => $category->id
        ];

        $response = $this->put(route('updateCategory', $category->id), $dataUpload);

        $response->assertOk();
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'category_name' => 'Updated Category',
        ]);
    }
        
}
