<div class="modal fade" id="showProjectModal{{$project->id}}" tabindex="-1" aria-labelledby="createProjectLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{  $project->name  }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
            </div>
            <div class="modal-body">
                <ul>
                    <li>Status: {{  $project->status  }}</li>
                    <li>Completion: {{  $project->completion  }} %</li>
                </ul>
                <form action="{{ route('projects.destroy', ['project' => $project->id]) }}" method="POST"
                    style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-md btn-danger me-3">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>