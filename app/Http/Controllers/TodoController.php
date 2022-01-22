<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoDestroyRequest;
use App\Http\Requests\TodoIndexRequest;
use App\Http\Requests\TodoPatchRequest;
use App\Http\Requests\TodoShowRequest;
use App\Http\Requests\TodoStoreRequest;
use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TodoController extends Controller
{
    /**
     * Display only user's todos.
     * @param TodoIndexRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(TodoIndexRequest $request)
    {
        $user_id = User::where('api_token', $request->bearerToken())->first()['id'];
        $todos = new TodoCollection(Todo::where('user_id', $user_id)->get());
        return response($todos, 200);
    }

    public function store(TodoStoreRequest $request)
    {

        $validated = $request->validated();

        $todo_author_id = User::where('api_token', $request->bearerToken())->first()['id'];

        $validated['description'] = $validated['description'] ?? '';
        $validated['tags']        = $validated['tags'] ?? '[]';

        Todo::create([
            'user_id'       => $todo_author_id,
            'title'         => $validated['title'],
            'description'   => $validated['description'],
            'tags'          => $validated['tags']
        ]);

        return response([
            'message' => 'The todo was successful created'
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TodoShowRequest $request, $id)
    {

        $todo = Todo::find($id);

        $resp = $todo ? new TodoResource($todo) : [
            'error' => 'Todo with such id not found'
        ];

        return response($resp, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodoPatchRequest $request, $id)
    {

        $todo = Todo::findOrFail($id);

        $todo->title        = $request->validated()['title'] ?? $todo->title;
        $todo->description  = $request->validated()['description'] ?? $todo->description;
        $todo->completed    = $request->validated()['completed'] ?? $todo->completed;
        $todo->tags         = $request->validated()['tags'] ?? $todo->tags;

        $todo->save();

        return response([
            'message' => 'The todo was successful edited'
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoDestroyRequest $request, $id)
    {

        $todo = Todo::find($id);
        $todo->delete();

        return response([
            'message' => 'The todo was successful destroyed'
        ], 200);

    }

}
