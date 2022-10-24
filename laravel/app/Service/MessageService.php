<?php

namespace App\Service;

use App\Http\Requests\MessageRequest;
use Illuminate\Support\Str;
use App\Models\Message;
use Exception;
use Log;
use Illuminate\Support\Facades\Storage;

class MessageService implements MessageServiceInterface
{
    public function create(MessageRequest $message_request): Message
    {
        $message = new Message();
        $id = Str::uuid();

        $message->setId((string) $id);

        if ($message_request->messages !== '' && !is_null($message_request->message)) {
            $message->setContent($message_request->message);
        }

        //$this->uploadFile($message, $message_request);

        $file = $id . '.jpg';
        $message->setFilePath($file);

        $message->save();

        return $message;
    }

    public function uploadFile(Message $message, MessageRequest $message_request): void
    {
        $id = $message->getId();
        $file = $id . '.jpg';
        list(, $image) = explode(';', $message_request->image);
        list(, $image) = explode(',', $image);

        $decoded_image = base64_decode($image);
        $is_success = Storage::disk('s3')->put($file, $decoded_image);
        if (!$is_success) {
            throw new Exception('ファイルアップロード時にエラーが発生しました。');
        }
    }

    public function find(string $id): Message
    {
        $message = Message::find($id);
        return $message;
    }
}