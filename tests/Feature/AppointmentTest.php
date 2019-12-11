<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    public function testCreate()
    {
        Auth::loginUsingId(1);
        $response = $this->post('/signup', ['service' => 1, 'interval' => 1]);
        $response->assertStatus(200);
        $response->assertJson(['status' => 1]);

        Auth::logout();
        $response = $this->post('/signup', ['service' => 1, 'interval' => 1]);
        $response->assertStatus(302);
    }
}
