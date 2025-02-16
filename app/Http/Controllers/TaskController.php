<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * show all tasks from specific project
     * 
     * @param $projectId
     * @return View
     */
    public function create($project = null): View{
        return view("projects.create_task", compact('project'));
    }

    public function store(Request $request): RedirectResponse{
        $task = Task::create([
            'name' => $request->name,
            'status' => $request->status,
            'project' => $request->project,
            'weight' => $request->weight
        ]);

        $this->updateProjectStatusAndCompletion($task->project);
        return redirect()->route('projects.index')->with('success','Task berhasil disimpan');
    }

    public function show(string $task_id): View {
        $task = Task::find($task_id);

        return view('projects.show_task', compact('task'));
    }

    public function edit(string $task_id): View {
        $task = Task::find($task_id);

        return view('projects.edit_task', compact('task'));
    }

    public function update(Request $request, $task_id) {
        $task = Task::findOrFail($task_id);
        $task->update([
            'name' => $request->name,
            'status'=> $request->status,
            'project' => $request->project,
            'weight' => $request->weight
        ]);

        $this->updateProjectStatusAndCompletion($task->project);
        return redirect()->route('projects.index')->with('success','Data berhasil diubah!');
    }

    public function destroy(string $task_id): RedirectResponse {
        $task = Task::find($task_id);
        $task->delete();

        $this->updateProjectStatusAndCompletion($task->project);
        return redirect()->route('projects.index')->with('success','Task berhasil dihapus!');
    }

    private function updateProjectStatusAndCompletion(string $project): void {
        (new ProjectController)->updateStatusAndCompletion($project);
    }
}
