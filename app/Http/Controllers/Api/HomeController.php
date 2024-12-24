<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Traits\ApiResponse;
use App\Traits\TaskTrait;

class HomeController extends Controller
{
    use TaskTrait, ApiResponse;

    public function taskStore(TaskRequest $request)
    {
        $this->storeTask($request);
        return response()->json($this->withSuccess('Task created successfully.'));
    }

    public function taskList()
    {
        $user = auth()->user();
        $tasks = $user->tasks()->orderBy('due_date', 'ASC')->get();

        $formatedTasks = $tasks->map(function ($task) {
            return [
                'title' => $task->title,
                'details' => $task->details,
                'due_date' => customDate($task->due_date),
                'status' => ($task->status == 0 ? 'Pending' : ($task->status == '1' ? 'In Progress' : ($task->status == '2' ? 'Completed' : 'Unknown'))),
                'created_at' => $task->created_at,
            ];
        });

        return response()->json($this->withSuccess($formatedTasks));
    }

    public function taskUpdate(TaskRequest $request, $id)
    {
        $this->updateTask($request, $id);
        return response()->json($this->withSuccess('Task updated successfully.'));
    }

    public function taskDelete($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json($this->withError('Task Not Found.'));
        }

        $task->delete();
        return response()->json($this->withSuccess('Task deleted successfully.'));

    }

}
