<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Model\Tasks;

class TasksController extends Controller
{
    public function getTasks()
    {
        $task = new Tasks;
        $date = new \DateTime('NOW');
        $currentDateTime = $date->format('Y-m-d H:i');
        $tasks = $task->where('expiry', '>=', $currentDateTime)
            ->where('active', 1)
            ->get();
        $this->updateExpiredTasks();
        return json_encode($tasks);
    }

    public function updateExpiredTasks()
    {
        $task = new Tasks;
        $task->where('expiry', '<', new \DateTime('NOW'))
            ->where('active', 1)
            ->update(array('active' => 0));
    }

    public function closeTask($id)
    {
        $task = new Tasks;
        $closed = $task->find($id);
        $closed->active = 0;
        $closed->save();
    }

    public function addTask(Request $request)
    {
        $userInput = $request->input('task');
        $inputDate = new \DateTime($request->input('inputDate'));
        $task = new Tasks;
        $task->task = $userInput;
        $task->expiry = $inputDate->format('Y-m-d H:i:s');
        $task->active = 1;
        $task->save();
    }
}
