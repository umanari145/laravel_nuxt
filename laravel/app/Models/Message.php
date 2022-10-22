<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // intが自動で型変換されてしまうのでつける
    protected $casts = [
        'id' => 'string'
    ];

    protected $primaryKey = "id";


    protected $guarded = [];

    public function setId(string $uuid): void
    {
        $this->id = $uuid;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setFilePath(string $file_path): void
    {
        $this->file_path = $file_path;
    }

    public function getFilePath(): string
    {
        return $this->file_path;
    }
}
