<?php

namespace App\Traits;

use App\Models\Task;
use Carbon\Carbon;

trait TaskTrait
{

    public function storeTask($request)
    {
        $task = new Task();
        $task->user_id = auth()->user()->id;
        $task->title = $request->title;
        $task->details = $request->details;
        $task->due_date = Carbon::parse($request->due_date);
        $task->status = $request->status;
        $task->save();

        return $task;
    }

    public function updateTask($request, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->title;
        $task->details = $request->details;
        $task->due_date = Carbon::parse($request->due_date);
        $task->status = $request->status;
        $task->save();

        return $task;
    }

}
