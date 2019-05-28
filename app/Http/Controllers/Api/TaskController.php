<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Task;
use App\Models\User;
use App\Http\Resources\Task as TaskResource;

class TaskController extends Controller
{
    /**
     * Display a listing of tasks. Tasks are paginated with 15 per page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //$tasks = Task::orderBy('created_at', 'asc')->paginate();
            $tasks = Task::orderBy('created_at', 'asc')->get();
            return TaskResource::collection($tasks);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Store a newly created task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'body' => 'required|string|max:255',
                'user_id' => 'exists:users,id',
            ]);

            $task = new Task;
            $task->text = $request->body;

            //if user is not posted, provide randomly select user
            if (!isset($request['user_id'])) {
                $task->user_id = User::inRandomOrder()->first()->id;
            } else {
                $task->user_id = $request->user_id;
            }

            $task->save();
            return new TaskResource($task);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $task = Task::findOrFail($id);
            return new TaskResource($task);
        } catch (ModelNotFoundException $e){
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'body' => 'required|string|max:255',
                'completed' => 'numeric',
                'user_id' => 'exists:users,id',
            ]);
            $task = Task::findOrFail($id);
            $task->text = $request->body;

            if (isset($request['completed'])) {
                if($request['completed'] == 1){
                    $task->is_completed = 1;
                }else{
                    $task->is_completed = 0;
                }
            }
            
            if (isset($request['user_id'])) {
                $task->user_id = $request->user_id;
            }

            $task->save();
            return new TaskResource($task);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 404);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return new TaskResource($task);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 404);
        }
    }
}
