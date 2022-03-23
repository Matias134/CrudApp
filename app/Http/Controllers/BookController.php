<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::join('authors', 'authors.id', '=', 'books.author_id')
                    ->select('books.id', 'books.name', 'image', 'authors.id as author_id',
                         'authors.name as author_name', 'authors.last_name as author_last_name')
                    ->paginate(5);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::select('id', 'name', 'last_name')->get();
        return view('books.create', compact('authors'));
    }

    public function store(StoreBookRequest $request)
    {
        try {

            $image = $request->file('image')->store('public/images');
            $url = Storage::url($image);

            $book = new Book();
            $book->name = $request->name;
            $book->description = $request->description;
            $book->image = $url;
            $book->number_of_pages = $request->number_of_pages;
            $book->year_of_publication = $request->year_of_publication;
            $book->author_id = $request->author_id;
            
            $book->save();
            return redirect()->route('book.create')->with('success', '¡Se ha creado un libro correctamente!');

        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->route('book.create')->with('failed', 'Ha ocurrido un error inesperado');
        }
    }

    public function show(Book $book)
    {
        $book = Book::join('authors', 'authors.id', '=', 'books.author_id')
                ->select('books.name', 'image', 'description',
                    'number_of_pages', 'year_of_publication', 'authors.id as author_id',
                    'authors.name as author_name', 'authors.last_name  as author_last_name')
                ->where('books.id', '=', $book->id)
                ->first();
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $book = Book::join('authors', 'authors.id', '=', 'books.author_id')
                ->select('books.id','books.name', 'image', 'description',
                    'number_of_pages', 'year_of_publication', 'authors.id as author_id',
                    'authors.name as author_name', 'authors.last_name  as author_last_name')
                ->where('books.id', '=', $book->id)
                ->first();
        $authors = Author::select('id', 'name', 'last_name')->get();
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        try {
            $book->update($request->all());
            return redirect()->route('book.edit', $book->id)->with('success', '¡Se ha editado un libro correctamente!');
        } catch (Throwable $th) {
            // throw $th;
            return redirect()->route('book.edit')->with('failed', 'Ha ocurrido un error inesperado');
        }
    }

    public function update_image(Request $request, Book $book)
    {
        try {
            
            $request->validate([
                'image' => 'required|image'
            ]);

            //Agregar imagen nueva
            $image = $request->file('image')->store('public/images');
            $url_image = Storage::url($image);

            //Eliminar imagen anterior
            $url = str_replace('storage', 'public', $book->image);
            Storage::delete($url);

            $book->image = $url_image;
            $book->update();

            return redirect()->route('book.index')->with('success', '¡Se ha editado la imagen de un libro correctamente!');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->route('book.index')->with('failed', 'Ha ocurrido un error inesperado');
        }
    }

    public function destroy(Book $book)
    {
        try {
            
            $book->delete();
            $url_image = str_replace('storage', 'public', $book->image);
            Storage::delete($url_image);
            return redirect()->route('book.index')->with('success', '¡Se ha eliminado un libro correctamente!');

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
