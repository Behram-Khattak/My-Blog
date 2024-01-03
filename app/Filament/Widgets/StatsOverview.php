<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Categories', Category::count())
                ->icon('heroicon-o-list-bullet'),

            Stat::make('Posts', Post::count())
                ->icon('heroicon-o-clipboard-document-list'),

            Stat::make('Tags', Tag::count())
                ->icon('heroicon-o-tag'),

            Stat::make('Comments', Comment::count())
                ->icon('heroicon-o-chat-bubble-left-right'),

            Stat::make('Likes', '20')
                ->icon('heroicon-o-hand-thumb-up'),
        ];
    }
}
