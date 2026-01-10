<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with('user')->latest();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $news = $query->paginate(9);

        return view('pages.news.index', compact('news'));
    }

    public function show($slug)
    {
        $item = News::where('slug', $slug)->firstOrFail();
        return view('pages.news.show', compact('item'));
    }

    public function create()
    {
        return view('pages.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|in:berita,pengumuman,kegiatan',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        News::create($data);
        return redirect()->route('news.index')->with('success', 'Berita berhasil dipublikasi.');
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->delete();
        return back()->with('success', 'Berita dihapus');
    }
}
