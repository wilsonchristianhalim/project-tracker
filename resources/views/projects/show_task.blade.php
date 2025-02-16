<div class="modal fade" id="showTaskModal{{$task->id}}" tabindex="-1" aria-labelledby="createTaskLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{  $task->name  }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
            </div>
            <div class="modal-body">
                <ul>
                    <li>Status: {{  $task->status  }}</li>
                    <li>Project ID: {{  $task->project  }}</li>
                    <li>Bobot: {{  $task->weight  }}</li>
                </ul>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-0">
                        <button type="button" class="btn btn-md btn-primary me-2 btn-edit-task"
                            data-task-id="{{ $task->id }}" data-task-name="{{ $task->name }}"
                            data-task-status="{{ $task->status }}" data-task-project="{{ $task->project }}"
                            data-task-weight="{{ $task->weight }}">Edit
                        </button>

                        <form action="{{ route('tasks.destroy', ['task' => $task->id]) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-md btn-danger me-3">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('projects.edit_task')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        console.log("Checking if .btn-edit-task exists:", $(".btn-edit-task").length);
        $(".btn-edit-task").off("click").on("click", function () {
            console.log("Button clicked!");
            $(".modal").modal("hide");

            setTimeout(() => {
                let taskId = $(this).data("task-id");
                let taskName = $(this).data("task-name");
                let taskStatus = $(this).data("task-status");
                let taskProject = $(this).data("task-project");
                let taskWeight = $(this).data("task-weight");

                console.log("Opening edit modal for task:"); // Debugging

                // Mengisi form edit dengan data yang sesuai
                $("#editTaskForm").attr("action", "/tasks/" + taskId);
                $("#editTaskName").text(taskName);
                $("#taskName").val(taskName);
                $("#taskStatus").val(taskStatus);
                $("#taskProject").val(taskProject);
                $("#taskWeight").val(taskWeight);

                // Menampilkan modal edit
                $("#editTaskModal").modal("show");
            }, 200);
        });
    });
</script>