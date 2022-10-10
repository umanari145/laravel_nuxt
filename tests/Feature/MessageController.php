<?php

namespace Tests\Feature;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageController extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->postJson('/api/message', [
            'content' => '本日は晴天なり',
            'file_path' => ''
        ]);
        $res = $response->json();
        $message = Message::find($res['uuid']);
        $this->assertSame($res['uuid'], $message->getId());
        $response->assertStatus(201);
    }
}
