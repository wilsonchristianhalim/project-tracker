<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group mb-3">
                                <h3>ADD TASK</h3>
                            </div>

                            <div class="form-group mb-3 row">
                                <label class="col-sm-1 col-form-label font-weight-bold">Task Name</label>
                                <div class="col-sm-4">
                                    <input type="text" name="name" placeholder="Masukkan Judul Task" class="form-control">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label class="col-sm-1 col-form-label font-weight-bold">Status</label>
                                <div class="col-sm-4">
                                    <input type="text" name="status" placeholder="Masukkan Status Task" class="form-control">
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label class="col-sm-1 col-form-label font-weight-bold">Project ID</label>
                                <div class="col-sm-4">
                                    @if($project)
                                        <input type="text" name="project" value="{{ $project }}" class="form-control" readonly>
                                    @else
                                        <input type="text" name="project" class="form-control" placeholder="Masukkan ID Project">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <label class="col-sm-1 col-form-label font-weight-bold">Weight</label>
                                <div class="col-sm-4">
                                    <input type="text" name="weight" placeholder="Masukkan Bobot Task" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-0">
                                    <button type="submit" class="btn btn-md btn-primary me-3">Submit</button>
                                    <button type="button" class="btn btn-md btn-danger" onclick="window.history.back()">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
</body>
</html> -->

<div class="modal fade" id="createTaskModal{{isset($project) ? $project->id : ''}}" tabindex="-1" aria-labelledby="createTaskLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>ADD TASK</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
            </div>
            <div class="modal-body">
                <form id="createTaskForm" action="{{ route('tasks.store') }}" method="POST">
                    
                    @csrf

                    <div class="form-group mb-3 row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Task Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="name" placeholder="Masukkan Judul Task" class="form-control">
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Status</label>
                        <div class="col-sm-6">
                            <input type="text" name="status" placeholder="Masukkan Status Task" class="form-control">
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Project ID</label>
                        <div class="col-sm-6">
                            @if($project)
                                <input type="text" name="project" value="{{ $project->id }}" class="form-control" readonly>
                            @else
                                <input type="text" name="project" class="form-control" placeholder="Masukkan ID Project">
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <label class="col-sm-3 col-form-label font-weight-bold">Weight</label>
                        <div class="col-sm-6">
                            <input type="text" name="weight" placeholder="Masukkan Bobot Task" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-10 offset-sm-0">
                            <button type="submit" class="btn btn-md btn-primary me-3">Submit</button>
                            <button type="button" class="btn btn-md btn-danger"
                                onclick="window.history.back()">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#createTaskForm').submit(function (e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('tasks.store') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "BERHASIL",
                        text: "Task berhasil ditambahkan!",
                        showConfirmButton: false,
                        timer: 2000
                    });

                    $('#createTaskModal').modal('hide');
                    $('#createTaskForm')[0].reset();
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