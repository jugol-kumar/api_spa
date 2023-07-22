<?php

namespace App\Http\Controllers;

use App\Events\SendMail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class TaskController extends Controller
{
    public function userTasks($id){
        return Task::with("taskUsers")->where("user_id", $id)->get();
    }

    public function singleTask($id){
        return Task::with("taskUsers")->findOrFail($id);
    }

    public function assignedUser(Request $request){
        $task = Task::findOrfail($request->input('taskId'));
        $data=[
            'task_id' => $task->id,
            'user_id' => $request->input('userId')
        ];

        $user = User::findOrFail($request->input('userId'));
        // event dispatch
        Event::dispatch(new SendMail($user->id));

        // assigned user in this task
        $task->taskUsers()->attach($data);
        return true;
    }

}
