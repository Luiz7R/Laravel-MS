<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    
    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('Login');
    }
    
    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = User::factory()->create(); 
        
        $response = $this->actingAs($user)->get('/login');
        $response->assertDontSeeText('Login');
        $response->assertRedirect();
        $response->assertStatus(302);
    } 
    
    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create();

        $credentials = [
            'email' => $user->email,
            'password' => 'password'
       ];

       $response = $this->post(route('msLogin'), $credentials);
       $response->assertRedirect();
       $response->assertStatus(302);

    }
    
}
