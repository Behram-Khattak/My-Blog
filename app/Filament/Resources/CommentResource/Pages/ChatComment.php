<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use Filament\Resources\Pages\Page;

class ChatComment extends Page
{
    protected static string $resource = CommentResource::class;

    protected static string $view = 'filament.resources.comment-resource.pages.chat-comment';

    public function mount(): void
    {
        static::authorizeResourceAccess();
    }
}
