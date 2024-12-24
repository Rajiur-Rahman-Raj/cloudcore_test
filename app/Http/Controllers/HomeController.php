<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Traits\TaskTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use TaskTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.home');
    }

    public function addTask()
    {
        return view('user.task.add');
    }

    public function taskStore(TaskRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->storeTask($request);
            DB::commit();
            return back()->with('success', 'Task added successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors([$e->getMessage()]);
        }
    }

    public function taskList(Request $request)
    {
        $search = $request->all();
        $due_date = isset($search['due_date']) ? Carbon::parse($search['due_date']) : null;

        $data['tasks'] = Task::orderBy('due_date', 'ASC')
            ->when(isset($search['title']), function ($query) use ($search) {
                return $query->where('title', 'LIKE', "%{$search['title']}%");
            })
            ->when(isset($search['due_date']), function ($query) use ($due_date) {
                return $query->whereDate('due_date', '=', $due_date);
            })
            ->when(isset($search['status']) && $search['status'] !== 'all', function ($query) use ($search) {
                return $query->where('status', '=', $search['status']);
            })
            ->paginate(1);

        return view('user.task.list', $data);
    }

    public function taskEdit($id)
    {
        $data['task'] = Task::findOrFail($id);
        return view('user.task.edit', $data);
    }

    public function taskUpdate(TaskRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->updateTask($request, $id);
            DB::commit();
            return back()->with('success', 'Task updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors([$e->getMessage()]);
        }
    }

    public function taskDelete($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return back()->with('error', 'Task not found');
        }

        $task->delete();
        return back()->with('success', 'Task deleted successfully');
    }
}
