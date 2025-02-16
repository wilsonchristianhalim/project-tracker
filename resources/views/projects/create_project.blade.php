<div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>ADD PROJECT</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" />
            </div>
            <div class="modal-body">
                <form id="createProjectForm" action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="form-label">Project Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan Judul Project"
                            required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#createProjectForm').submit(function (e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('projects.store') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "BERHASIL",
                        text: "Project berhasil ditambahkan!",
                        showConfirmButton: false,
                        timer: 2000
                    });

                    $('#createProjectModal').modal('hide');
                    $('#createProjectForm')[0].reset();
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