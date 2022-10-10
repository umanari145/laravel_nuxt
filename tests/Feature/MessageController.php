<?php

namespace Tests\Feature;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
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
        $file = UploadedFile::fake()->image('item.jpg');
        $file_ext = $file->getClientOriginalExtension();
        $data = base64_encode(file_get_contents($file));
        $src = 'data: ' . $file_ext . ';base64,' . $data;

        $response = $this->postJson('/api/message', [
            'message' => '本日は晴天なり',
            'image' => $src
        ]);
        $res = $response->json();
        dd($res);
        $message = Message::find($res['uuid']);
        $this->assertSame($res['uuid'], $message->getId());
        $response->assertStatus(201);
    }
}
