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

            $yearValidated = $this->validateYearOfBirth($year_of_birth);

            if( !$yearValidated ) {
                return redirect()->route('author.create')->with('failed', 'El año de nacimiento no puede ser mayor al año al actual');
            } 

            if( $age < 6 || $age > 124 ) {
                return redirect()->route('author.create')->with('failed', 'El calculo de la edad es "'.$age.'" esta se encuentra fuera de los rangos permitidos(6 - 124)');
            }

            $author = new Author($request->all());
            $author->save();
            return redirect()->route('author.create')->with('success', '¡Autor creado correctamente!');

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

            $yearValidated = $this->validateYearOfBirth($year_of_birth);

            if( !$yearValidated ) {
                return redirect()->route('author.edit', $author)->with('failed', 'El año de nacimiento no puede ser mayor al año al actual');
            } 

            if( $age < 6 || $age > 124 ) {
                return redirect()->route('author.edit', $author)->with('failed', 'El calculo de la edad es "'.$age.'" esta se encuentra fuera de los rangos permitidos(6 - 124)');
            }

            $author->update($request->all());
            return redirect()->route('author.edit', $author)->with('success', '¡Autor editado correctamente!');

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
        $start_date = new DateTime($year_of_birth);
        if($year_of_death == null) {
            $end_date = new DateTime('NOW');
        } else {
            $end_date = new DateTime($year_of_death);
        }

        $age = $start_date->diff($end_date);

        return $age->format('%r%y');
    }

    public function validateYearOfBirth( $year_of_birth )
    {
        list( $year ) = explode('-', $year_of_birth);
        $currentYear = new DateTime('NOW');
        $currentYear = $currentYear->format('Y');
        if( $year > $currentYear ) {
            return false;
        } else {
            return true;
        }
    }

}
