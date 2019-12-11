<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Doctor;

class DoctorTest extends TestCase
{
    public function testDoctor()
    {
        $db_doctor = Doctor::find(1);

        $response = $this->get('/doctors/1');

        $response->assertStatus(200);
        $response->assertSeeText($db_doctor->name);
    }

    public function testDoctorsList()
    {
        $response = $this->get('/doctors');

        $response->assertStatus(200);
    }
}
