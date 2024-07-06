<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::all();
        return view('content.index', compact('contents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('public/images');
            $publicPath = Storage::url($path);

            Content::create([
                'title' => $request->title,
                'body' => $request->body,
                'image_path' => $publicPath,
            ]);

            return redirect()->route('content.index')->with('success', 'Content created successfully.');
        }

        return back()->withInput()->withErrors(['image' => 'Image upload failed']);
    }

    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();

        return redirect()->route('content.index')->with('success', 'Content deleted successfully.');
    }
}
