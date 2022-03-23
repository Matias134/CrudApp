<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use DateTime;
use DateTimeZone;
use Throwable;

class AuthorController extends Controller
{
    
    public function index()
    {
        $authors = Author::select('id', 'name', 'last_name', 'year_of_birth')->orderBy('id')->paginate(5);
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(StoreAuthorRequest $request)
    {
        try {
            $year_of_birth = $request->year_of_birth;
            $year_of_death = $request->year_of_death;
            
            $age = $this->getAge($year_of_birth, $year_of_death);
            
            if($this->validateAge($year_of_birth, $year_of_death))
            {
                $author = new Author($request->all());
                $author->save();
                return redirect()->route('author.create')->with('success', '¡Autor creado correctamente!');
            }else{
                return redirect()->route('author.create')->with('failed', 'El calculo de la edad es "'.$age.'" esta se encuentra fuera de los rangos permitidos(6 - 124)');
            }
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->route('author.create')->with('failed', 'Ha ocurrido un error inesperado');
        }
    }

    public function show(Author $author)
    {
        $year_of_birth = $author->year_of_birth;
        $year_of_death = $author->year_of_death;
        $age = $this->getAge($year_of_birth, $year_of_death);
        $author->age = $age;

        return view('authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(UpdateAuthorRequest $request, Author $author)
    {
        try {
            $year_of_birth = $request->year_of_birth;
            $year_of_death = $request->year_of_death;

            $age = $this->getAge($year_of_birth, $year_of_death);

            if($this->validateAge($year_of_birth, $year_of_death)){
                $author->update($request->all());
                return redirect()->route('author.edit', $author)->with('success', '¡Autor editado correctamente!');
            }else{
                return redirect()->route('author.edit', $author)->with('failed', 'El calculo de la edad es "'.$age.'" esta se encuentra fuera de los rangos permitidos');
            }
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->route('author.edit', $author)->with('failed', 'Ha ocurrido un error inesperado');
        }
    }

    public function destroy(Author $author)
    {
        try {
            $author->delete();
            return redirect()->route('author.index')->with('success', '¡El autor se ha eliminado correctamente!');
        } catch ( Throwable $th) {
            // throw $th;
            return redirect()->route('author.index')->with('failed', 'Ha ocurrido un error inesperado');
        }
    }
    
    public function getAge($year_of_birth, $year_of_death)
    {
        $start = new DateTime($year_of_birth);
        if($year_of_death != null){
            $end = new DateTime($year_of_death);
        }else{
            $end = new DateTime();
            $end->setTimezone(new DateTimeZone('America/Santiago'));
        }
        $age = $start->diff($end);
        return $age->y;
    }

    public function validateAge($year_of_birth, $year_of_death)
    {
        $age = $this->getAge($year_of_birth, $year_of_death);
        if($age > 5 && $age < 125){
            return true;
        }else{
            return false;
        }
    }
}
