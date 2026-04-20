<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                return redirect('/')->with('error', 'Unauthorized access');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $search = request('search');
        $status = request('status');

        $query = News::with('author');

        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        }

        if ($status === 'published') {
            $query->where('is_published', true);
        } elseif ($status === 'draft') {
            $query->where('is_published', false);
        }

        $news = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.news.index', [
            'news' => $news,
            'search' => $search,
            'status' => $status,
        ]);
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('news', 'public');
        }

        News::create([
            'title' => $request->title,
            'content' => $request->input('content'),
            'featured_image' => $imagePath,
            'is_published' => $request->is_published ? true : false,
            'published_at' => $request->is_published ? now() : null,
            'posted_by' => Auth::id(),
        ]);

        return redirect()->route('admin.news.index')
            ->with('success', 'News created successfully');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);

        return view('admin.news.edit', [
            'news' => $news,
        ]);
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->input('content'),
            'is_published' => $request->is_published ? true : false,
        ];

        if ($request->is_published && !$news->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            if ($news->featured_image) {
                Storage::disk('public')->delete($news->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'News updated successfully');
    }

    public function delete($id)
    {
        $news = News::findOrFail($id);

        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News deleted successfully');
    }
}
