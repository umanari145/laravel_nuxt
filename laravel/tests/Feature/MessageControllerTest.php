<?php

namespace Tests\Feature;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class MessageControllerTest extends TestCase
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

    public function testpPostUploadImageNotBase64()
    {
        $file = UploadedFile::fake()->image('item.jpg');
        $sample_dir = 'hogehoge_dir';

        // ↓ 以下の書き方だとfile名がハッシュになる
        //$file_path = Storage::disk('s3')->put($sample_dir, $file);
        $file_path = Storage::disk('s3')->putFileAs($sample_dir, $file, $file->getClientOriginalName());
        $url = Storage::disk('s3')->url($file_path);
        $expected_url = sprintf('%s/%s/%s/%s', env('AWS_ENDPOINT'), env('AWS_BUCKET'), $sample_dir, $file->getClientOriginalName());
        // $url= "http://localstack:4566/sample/hogehoge_dir/item.jpg"
        $this->assertSame($expected_url, $url);
        // aws s3 ls s3://sample/hogehoge_dir/********  --endpoint-url=http://localhost:4566
        $this->assertTrue(Storage::disk('s3')->exists($file_path));
    }

    public function testpPostUploadImageNotBase64DummyData()
    {
        $file_name = 'dummy_airi.jpeg';
        $file_path = public_path($file_name);
        //UploadedFile
        $sample_dir = 'hogehoge_dir';
        $upload_file = new UploadedFile(
            $file_path,
            $file_name,
            'image/jpeg',
            null,
            true
        );
        // ↓ 以下の書き方だとfile名がハッシュになる
        //$file_path = Storage::disk('s3')->put($sample_dir, $file);
        $upload_file_path = Storage::disk('s3')->putFileAs($sample_dir, $upload_file, $file_name);
        $url = Storage::disk('s3')->url($upload_file_path);
        $url2 = parse_url($url);

        $expected_path = sprintf('/%s/%s/%s', env('AWS_BUCKET'), $sample_dir, $file_name);
        // $url= "http://localstack:4566/sample/hogehoge_dir/item.jpg"
        // http://localhost:4566/sample/hogehoge_dir/dummy_airi.jpeg (←でアクセス可能)
        $this->assertSame($expected_path, $url2['path']);
        // aws s3 ls s3://sample/hogehoge_dir/********  --endpoint-url=http://localhost:4566
        $this->assertTrue(Storage::disk('s3')->exists($upload_file_path));
    }
}
