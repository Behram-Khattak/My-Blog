<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;

class ChatComment extends Page
{
    use InteractsWithRecord;

    protected static string $resource = CommentResource::class;

    protected static ?string $title = 'Chat';

    protected static string $view = 'filament.resources.comment-resource.pages.chat-comment';

    public function mount(int | string $record): void
    {
        static::authorizeResourceAccess();

        $this->record = $this->resolveRecord($record);
    }
}
