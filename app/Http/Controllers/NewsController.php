<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $search = request('search');

        $query = News::where('is_published', true)->orderBy('published_at', 'desc');

        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        }

        $news = $query->paginate(10);

        return view('news.index', [
            'news' => $news,
            'search' => $search,
        ]);
    }

    public function show($id)
    {
        $newsItem = News::findOrFail($id);

        $relatedNews = News::where('is_published', true)
            ->where('id', '!=', $id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('news.show', [
            'news' => $newsItem,
            'relatedNews' => $relatedNews,
        ]);
    }
}
