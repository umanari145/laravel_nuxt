<?php

namespace Tests\Feature;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Tests\TestCase;

class MessageController extends TestCase
{
    use RefreshDatabase;

    /**
     * 新規登録
     *
     * @return void
     */
    public function test_store_example()
    {
        $response = $this->postUploadImage();
        $res = $response->json();
        $message = Message::find($res['uuid']);
        $this->assertSame($res['uuid'], $message->getId());
        $response->assertStatus(201);
    }

    /**
     * 詳細
     *
     * @return void
     */
    public function test_show_example()
    {
        $post_response = $this->postUploadImage();
        $response = $this->get('/api/message/' . $post_response['uuid']);
        $res = $response->json();
        $message = Message::first();
        $this->assertSame($res['message'], $message->getContent());
        $this->assertSame($res['url'], sprintf('%s/%s', config('app.image_url'), $message->getFilePath()));
        $response->assertStatus(200);

    }

    private function postUploadImage()
    {
        $file = UploadedFile::fake()->image('item.jpg');
        $file_ext = $file->getClientOriginalExtension();
        $data = base64_encode(file_get_contents($file));
        $src = 'data: ' . $file_ext . ';base64,' . $data;

        $response = $this->postJson('/api/message', [
            'message' => '本日は晴天なり',
            'image' => $src
        ]);
        return $response;
    }
}
