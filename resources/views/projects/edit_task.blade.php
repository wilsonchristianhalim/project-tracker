<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>EDIT TASK</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
            </div>
            <div class="modal-body">
                <form id="editTaskForm" action="{{ route('tasks.update', $task->id) }}" method="POST">
                    
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3 row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Task Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="name" id="taskName" placeholder="Masukkan Judul Task" class="form-control">
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Status</label>
                        <div class="col-sm-6">
                            <input type="text" name="status" id="taskStatus" placeholder="Masukkan Status Task" class="form-control">
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Project ID</label>
                        <div class="col-sm-6">
                            <input type="text" name="project" id="taskProject" class="form-control" placeholder="Masukkan ID Project">
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Weight</label>
                        <div class="col-sm-6">
                            <input type="text" name="weight" id="taskWeight" placeholder="Masukkan Bobot Task" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-md btn-primary me-3">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#editTaskForm').off("submit").on("submit", function (e) {
            e.preventDefault();
            let formData = $(this).serialize() + "&_method=PUT";
            let actionUrl = $(this).attr("action");

            $.ajax({
                url: actionUrl,
                type: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "BERHASIL",
                        text: "Task berhasil di-update!",
                        showConfirmButton: false,
                        timer: 2000
                    });

                    $('#createTaskModal').modal('hide');
                    $('#createTaskForm')[0].reset();
                    location.reload();
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: "error",
                        title: "GAGAL!",
                        text: "Terjadi kesalahan, coba lagi.",
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        });
    });
</script>