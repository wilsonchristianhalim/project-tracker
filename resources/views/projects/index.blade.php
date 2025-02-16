<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h2 class="text-center my-4" style="font-weight: bold">Project Tracker</h2>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <div class="d-flex justify-content-start mb-4">
                            <a href="#" class="btn btn-md btn-success mb-3 me-3" data-bs-toggle="modal" data-bs-target="#createProjectModal">ADD PROJECT</a>
                            @include('projects.create_project')
                            <a href="#" class="btn btn-md btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#createTaskModal">ADD TASK</a>
                            @include('projects.create_task', ['project' => null])
                        </div>
                        @forelse ($projects as $project)
                        <div class="d-flex align-items-center mb-2">
                            <p class="me-3 mb-0" style="font-weight: bold">{{  $project->id  }}.</p>
                            <a href="#" class="me-3" data-bs-toggle="modal" data-bs-target="#showProjectModal{{$project->id}}">{{ $project->name }}</a>
                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createTaskModal{{$project->id}}">+</a>

                        </div>
                        <div class="ms-4">
                            @forelse ($project->tasks as $task)
                                <div class="d-flex align-items-center mb-1">
                                    <span class="me-2">-</span>
                                    <a href="#" class="mb-0" data-bs-toggle="modal" data-bs-target="#showTaskModal{{$task->id}}">{{ $task->name }}</a>
                                    @include('projects.show_task')
                                </div>
                                @empty
                                    <p class="text-muted ms-2">No tasks available for this project.</p>
                                @endforelse
                        </div>
                        @include('projects.show_project')
                        @include('projects.create_task')
                         @empty
                            <div class="alert alert-danger">
                                Data Project belum Tersedia.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

    </script>
</body>
</html>