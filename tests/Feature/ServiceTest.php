<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Service;

class ServiceTest extends TestCase
{
    public function testService()
    {
        $db_service = Service::find(1);

        $response = $this->get('/services/1');

        $response->assertStatus(200);
        $response->assertSeeText($db_service->title);
    }
}
