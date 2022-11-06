<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteCollection;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Notecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = new NoteCollection(Auth::user()->notes);
        return response($notes, 200);
    }


    //создание заметки
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(NoteRequest $request)
    {
        $note = new Note();
        $note->title = $request->title;
        $note->body = $request->body;
        //сохраняем файл
        $path = $request->file('image')->store('public');
        $note->image = Storage::url($path);
        $note->user_id = Auth::user()->id;
        //метод url преобразовывает путь к файлу в url адрес 
        //Auth::user возвращает ссылку на авторизованного пользователя
        $note->save();
        return response(new NoteResource($note), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        if(Auth::user()->id != $note->user_id)
            return response(null, 403);
        return response(new NoteResource($note), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoteRequest $request, Note $note)
    {
        if(Auth::user()->id != $note->user_id)
        return response(null, 403);
        $note->title = $request->title;
        $note->body = $request->body;
        $path = $request->file('image')->store('public');
        $note->image = Storage::url($path);
        $note->save();

        return response(new NoteResource($note), 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        if(Auth::user()->id != $note->user_id)
        return response(null, 403);
        $note->delete();
        return response(null, 200);
    }
}
