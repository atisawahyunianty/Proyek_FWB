<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\{Book, Genre, Chapter};

class BukuController extends Controller
{
    // Menampilkan daftar buku
    public function lihatBuku()
    {
        $books = Book::with(['genres', 'chapters'])
                    ->where('user_id', auth()->id())
                    ->get();
        return view('penulis.lihatBuku', compact('books'));
    }

    // Menampilkan detail buku
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('penulis.detailBuku', compact('book'));
    }

    // Form tambah buku
    public function create()
    {
        return view('penulis.tambahBuku');
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'penulis' => 'required|string|max:255',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'genres' => 'required|string',
            'chapters' => 'nullable|array',
            'chapters.*.title' => 'nullable|string|max:255',
            'chapters.*.content' => 'nullable|string',
        ]);

        // Upload cover
        $coverPath = $request->file('cover_image')->store('covers', 'public');

        // Simpan buku
        $book = Book::create([
            'user_id' => auth()->id(),
            'judul' => $validated['judul'],
            'penulis' => $validated['penulis'],
            'isi' => $validated['isi'],
            'cover_image' => $coverPath,
        ]);

        // Proses genre (dipisah koma)
        $genreNames = array_map('trim', explode(',', $validated['genres']));
        $genreIds = [];

        foreach ($genreNames as $name) {
            if ($name === '') continue;

            $genre = Genre::firstOrCreate([
                'name' => Str::title($name)
            ]);

            $genreIds[] = $genre->id;
        }

        $book->genres()->attach($genreIds);

        // Tambahkan chapters
       if ($request->has('chapters')) {
    foreach ($request->chapters as $chapter) {
        $title = $chapter['title'] ?? null;
        $content = $chapter['content'] ?? null;

        if (!empty($title) || !empty($content)) {
            $book->chapters()->create([
                'title' => $title ?: 'Tanpa Judul',
                'content' => $content ?: '-'
            ]);
        }
    }
}


        return redirect()->route('penulis.lihatBuku')->with('success', 'Buku berhasil ditambahkan!');
    }

    // Form edit buku
    public function edit($id)
    {
        $buku = Book::with('chapters')->findOrFail($id);
        $genres = Genre::all();

        return view('penulis.editBuku', compact('buku', 'genres'));
    }

    // Update data buku
    public function update(Request $request, $id)
    {
        $buku = Book::findOrFail($id);

        $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'isi' => 'required|string',
            'cover_image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->isi = $request->isi;

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('covers', 'public');
            $buku->cover_image = $path;
        }

        $buku->save();

        return redirect()->route('penulis.lihatBuku')->with('success', 'Buku berhasil diperbarui!');
    }

    // Hapus buku
    public function destroy($id)
    {
        $buku = Book::findOrFail($id);
        $buku->delete();

        return redirect()->route('penulis.lihatBuku')->with('success', 'Buku berhasil dihapus!');
    }

    // Tambah chapter (manual, bukan dari form tambah buku)
    public function tambahChapter(Request $request, $id)
    {
        $request->validate([
            'judul_chapter' => 'required|string|max:255',
            'isi_chapter' => 'nullable|string'
        ]);

        $buku = Book::findOrFail($id);

        if ($buku->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        $buku->chapters()->create([
            'title' => $request->judul_chapter,
            'content' => $request->isi_chapter ?? ''
        ]);

        return redirect()->back()->with('success', 'Chapter baru berhasil ditambahkan!');
    }
}
