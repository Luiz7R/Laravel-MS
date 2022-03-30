<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Factory;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class GuestTest extends TestCase
{
    
    public function test_guest_can_view_a_register_form()
    {
        $response = $this->get('/register');

        $response->assertSuccessful();
        $response->assertViewIs('Register');
    }
        
    public function test_guest_can_register_with_correct_requirements()
    {

        $credentials = [
            'name' => 'Name 3214',
            'email' => 'name3214@example.com',
            'password' => 'password',
            'sex' => 'Male',
       ];

       $response = $this->post(route('msRegister'), $credentials);
       $response->assertRedirect();
       $response->assertStatus(302);

    }
    
}
