<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index() : View {
        $projects = Project::with('tasks')->latest()->get();

        return View("projects.index", compact("projects"));
    }

    /**
     * create
     * @return View
     */
    // public function create() : View {
    //     return View('projects.create_project');
    // }

    /**
     * store
     * 
     * @param mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        Project::create([
            'name' => $request->name,
            'status' => 'Draft',
            'completion' => 0
        ]);

        return redirect()->route('projects.index')->with('success','Data berhasil disimpan');
    }

    public function show(string $project_id) : View {
        $project = Project::find($project_id);

        return view('projects.show_project', compact('project'));
    }

    public function destroy (string $project_id) : RedirectResponse {
        $project = Project::find($project_id);
        $project->delete();
        return redirect()->route('projects.index')->with('success','Project berhasil dihapus');
    }

    public function updateStatusAndCompletion(string $id): void{
        $project = Project::find($id);
        $tasks = $project->tasks;
        $totalWeight = 0;
        $completionWeight = 0;
        $status = "Draft";
        $doneStatus= 0;

        if ($tasks->isEmpty()) {
            $project->update (["status"=>"Draft","completion"=>0]);
            return;
        }

        foreach ($tasks as $task) {
            $totalWeight += $task->weight;

            if ($task->status == "On going") {
                $status = "On going";
            }
            elseif ($task->status == "Draft" && $status != "On going") {
                $status = "Draft";
            }
            elseif ($task->status == "Done") {
                $doneStatus += 1;
                $completionWeight += $task->weight;
            }
        }
        
        if ($doneStatus == count($tasks)) {
            $status = "Done";
        }

        if ($totalWeight == 0) {
            $completion = 0;
        }
        else{
            $completion =($completionWeight / $totalWeight) * 100;
        }

        $project->update(["status"=> $status,"completion"=> $completion]);
    }
}