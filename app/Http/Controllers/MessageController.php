<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Service\MessageServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    private MessageServiceInterface $message_service;

    public function __construct(MessageServiceInterface $message_service)
    {
        $this->message_service = $message_service;
    }

    public function store(MessageRequest $message_request): JsonResponse
    {
        $message = $this->message_service->create($message_request);
        $this->message_service->uploadFile($message, $message_request);
        return response()->json([
            'status' => 201,
            'uuid' => $message->getId(),
        ], 201);
    }
}
