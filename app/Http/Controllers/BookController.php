<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::with('user')->latest()->paginate(12);

        return view('books.index', compact('books'));
    }

    public function create(): View
    {
        return view('books.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'condition' => ['required', 'in:new,like_new,good,fair'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
        }

        $book = Book::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'author' => $validated['author'],
            'description' => $validated['description'],
            'condition' => $validated['condition'],
            'image' => $imagePath,
            'status' => 'available',
        ]);

        return redirect()->route('books.show', $book->id)
            ->with('success', 'Book added successfully.');
    }

    public function show(int $id): View
    {
        $book = Book::with('user')->findOrFail($id);

        return view('books.show', compact('book'));
    }

    public function myBooks(): View
    {
        $books = auth()->user()->books()->latest()->get();

        return view('dashboard', compact('books'));
    }
}
