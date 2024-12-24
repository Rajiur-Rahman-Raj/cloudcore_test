<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Traits\TaskTrait;
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

    public function taskStore(StoreTaskRequest $request)
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
}
