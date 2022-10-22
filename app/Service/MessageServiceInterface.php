<?php

namespace App\Service;

use App\Http\Requests\MessageRequest;
use App\Models\Message;

interface MessageServiceInterface
{
    public function create(MessageRequest $message_request): Message;

    public function uploadFile(Message $message, MessageRequest $message_request): void;

    public function find(string $id): Message;
}
