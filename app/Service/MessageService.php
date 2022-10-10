<?php

namespace App\Service;

use App\Http\Requests\MessageRequest;
use Illuminate\Support\Str;
use App\Models\Message;

class MessageService implements MessageServiceInterface
{
    public function create(MessageRequest $message_request): Message
    {
        $message = new Message();
        $id = Str::uuid();

        $message->setId((string) $id);

        if ($message_request->content !== '' && !is_null($message_request->content)) {
            $message->setContent($message_request->content);
        }

        if ($message_request->file_path !== '' && !is_null($message_request->file_path)) {
            $message->setFilePath($message_request->file_path);
        }

        $message->save();

        return $message;
    }
}