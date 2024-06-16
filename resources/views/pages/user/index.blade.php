@extends('layouts.dashboard')

@section('content')
<style>
body {
            background: linear-gradient(to bottom, #333, #6c757d); /* Gradient dari biru ke abu-abu */
            color: #fff; /* Warna teks putih */
        }
.iq-card {
    background-color: #f8f9fa; /* Warna latar belakang */
    border: 1px solid #dee2e6; /* Warna border */
    border-radius: 10px; /* Radius border */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Shadow */
    padding: 20px; /* Padding */
}

.iq-card-header {
    background-color: #333; /* Warna latar belakang header */
    color: #DC143C; /* Warna teks header */
    border-bottom: 1px solid #0056b3; /* Warna border bawah header */
    padding: 15px; /* Padding header */
}

.iq-card-body {
    color: #333; /* Warna teks body */
}

.iq-card-body table {
    background-color: #fff; /* Warna latar belakang tabel */
}

.iq-card-body table th,
.iq-card-body table td {
    border-color: #dee2e6; /* Warna border sel tabel */
    padding: 10px; /* Padding sel tabel */
}

.iq-card-body table th {
    background-color: #007bff; /* Warna latar belakang th tabel */
}

.iq-card-body table tbody tr:nth-child(even) {
    background-color: #f9f9f9; /* Warna latar belakang baris genap */
}

.iq-card-body table tbody tr:hover {
    background-color: #f1f1f1; /* Warna latar belakang saat hover */
}

.list-user-action a {
    color: #007bff; /* Warna ikon tombol aksi */
    margin-right: 5px; /* Margin kanan ikon tombol aksi */
}

.list-user-action a:hover {
    color: #DC143C; /* Warna ikon tombol aksi saat hover */
}
.card-title {
    font-weight: bold;
    color: #DC143C;
    font-size: 20px;
}

</style>
<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between align-items-center">
        <div class="iq-header-title">
            <h4 class="card-title">User List</h4>
        </div>
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addModal">
            <i class="las la-plus">Add User</i>
    </div>
    <div class="iq-card-body">
        <div class="table-responsive">
            <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Join Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>
                            @if ($user->phone_number == null)
                            <span class="badge badge-secondary">Belum diisi</span>
                            @else
                            {{ $user->phone_number }}
                            @endif
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->role == 'admin')
                            <span class="badge badge-primary">
                                <i class="ri-user-star-fill"></i>
                                Admin</span>
                            @else
                            <span class="badge badge-secondary">
                                <i class="ri-user-fill"></i>
                                User</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d M Y, H:i:s') }}</td>
                        <td>
                            <div class="flex align-items-center list-user-action">
                                <a onclick="openEditModal('{{ $user->id }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#">
                                    <i class="ri-pencil-line"></i></a>

                                <a onclick="deleteUser('{{ $user->id }}')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="form-group">
                        <label for="addName">Nama</label>
                        <input required type="text" class="form-control" id="addName" name="name">
                    </div>

                    <div class="form-group">
                        <label for="addEmail">Email</label>
                        <input required type="email" class="form-control" id="addEmail" name="email">
                    </div>

                    <div class="form-group">
                        <label for="addPhoneNumber">Phone Number</label>
                        <input required type="phone_number" class="form-control" id="addPhoneNumber" name="addPhoneNumber">
                    </div>

                    <div class="form-group">
                        <label for="addRole">Role</label>
                        <select class="form-control" id="addRole" name="role">
                            <option value="admin">Admin</option>
                            <option value="user" selected>User</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="addPassword">Password</label>
                        <input required type="password" class="form-control" id="addPassword" name="password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="createUser()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Ubah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="form-group">
                        <label for="editName">Nama</label>
                        <input required type="text" class="form-control" id="editName" name="name">
                    </div>

                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input required type="email" class="form-control" id="editEmail" name="email">
                    </div>

                    <div class="form-group">
                        <label for="editPhoneNumber">Phone Number</label>
                        <input required type="phone_number" class="form-control" id="editPhoneNumber" name="phone_number">
                    </div>

                    <div class="form-group">
                        <label for="editRole">Role</label>
                        <select class="form-control" id="editRole" name="role">
                            <option value="admin">Admin</option>
                            <option value="user" selected>User</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editPassword">Password</label>
                        <input required type="password" class="form-control" id="editPassword" name="password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="editUser()">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let userId = null;

    // saat buka modal addModal kosongkan form, hapus class is-invalid dan invalid-feedback
    $('#addModal').on('show.bs.modal', function(e) {
        $('#addForm').trigger('reset');
        $('#addPhoneNumber').val(),
            $('#addForm input').removeClass('is-invalid');
        $('#addForm .invalid-feedback').remove();
    })

    $('#addModal').on('show.bs.modal', function(e) {
        $('#editForm input').removeClass('is-invalid');
        $('#addPhoneNumber').val(),
            $('#editForm .invalid-feedback').remove();
    })

    function createUser() {
        const url = "{{ route('api.users.store') }}";

        // ambil form data
        let data = {
            name: $('#addName').val(),
            phone_number: $('#addPhoneNumber').val(),
            email: $('#addEmail').val(),
            role: $('#addRole').val(),
            password: $('#addPassword').val(),
        }

        // kirim data ke server POST /users
        $.post(url, data)
            .done((response) => {
                // tampilkan pesan sukses
                toastr.success(response.message, 'Sukses')

                // reload halaman setelah 3 detik
                setTimeout(() => {
                    location.reload()
                }, 3000);
            })
            .fail((error) => {
                // ambil response error
                let response = error.responseJSON

                // tampilkan pesan error
                toastr.error(response.message, 'Error')

                // tampilkan error validation
                if (response.errors) {
                    // loop object errors
                    for (const error in response.errors) {
                        // cari input name yang error pada #addForm
                        let input = $(`#addForm input[name="${error}"]`)

                        // tambahkan class is-invalid pada input
                        input.addClass('is-invalid');

                        // buat elemen class="invalid-feedback"
                        let feedbackElement = `<div class="invalid-feedback">`
                        feedbackElement += `<ul class="list-unstyled">`
                        response.errors[error].forEach((message) => {
                            feedbackElement += `<li>${message}</li>`
                        })
                        feedbackElement += `</ul>`
                        feedbackElement += `</div>`

                        // tambahkan class invalid-feedback setelah input
                        input.after(feedbackElement)
                    }
                }
            })
    }

    function editUser() {
        let url = "{{ route('api.users.update', ':userId') }}";
        url = url.replace(':userId', userId);

        // ambil form data
        let data = {
            name: $('#editName').val(),
            phone_number: $('#editPhoneNumber').val(),
            email: $('#editEmail').val(),
            password: $('#editPassword').val(),
            role: $('#editRole').val(),
            _method: 'PUT'
        }

        // kirim data ke server POST /users
        $.post(url, data)
            .done((response) => {
                // tampilkan pesan sukses
                toastr.success(response.message, 'Sukses')

                // reload halaman setelah 3 detik
                setTimeout(() => {
                    location.reload()
                }, 3000);
            })
            .fail((error) => {
                // ambil response error
                let response = error.responseJSON

                // tampilkan pesan error
                toastr.error(response.message, 'Error')

                // tampilkan error validation
                if (response.errors) {
                    // loop object errors
                    for (const error in response.errors) {
                        // cari input name yang error pada #editForm
                        let input = $(`#editForm input[name="${error}"]`)

                        // tambahkan class is-invalid pada input
                        input.addClass('is-invalid');

                        // buat elemen class="invalid-feedback"
                        let feedbackElement = `<div class="invalid-feedback">`
                        feedbackElement += `<ul class="list-unstyled">`
                        response.errors[error].forEach((message) => {
                            feedbackElement += `<li>${message}</li>`
                        })
                        feedbackElement += `</ul>`
                        feedbackElement += `</div>`

                        // tambahkan class invalid-feedback setelah input
                        input.after(feedbackElement)
                    }
                }
            })

    }

    function deleteUser(userId) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: 'User akan dihapus, kamu tidak bisa mengembalikannya lagi!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let url = "{{ route('api.users.destroy', ':userId') }}";
                url = url.replace(':userId', userId);
                $.post(url, {
                        _method: 'DELETE'
                    })
                    .done((response) => {
                        toastr.success(response.message, 'Sukses')
                        setTimeout(() => {
                            location.reload()
                        }, 1000);
                    })
                    .fail((error) => {
                        toastr.error('Gagal menghapus user', 'Error')
                    })
            }
        })
    }

    function openEditModal(id) {
        // mengisi variabel userId dengan id yang dikirim dari tombol edit
        userId = id;

        // ambil data user dari server
        let url = `{{ route('api.users.show', ':userId') }}`;
        url = url.replace(':userId', userId);

        // ambil data user
        $.get(url)
            .done((response) => {
                // isi form editModal dengan data user
                $('#editName').val(response.data.name);
                $('#editPhoneNumber').val(response.data.phone_number);
                $('#editEmail').val(response.data.email);

                // tampilkan modal editModal
                $('#editModal').modal('show');
            })
            .fail((error) => {
                // tampilkan pesan error
                toastr.error('Gagal mengambil data user', 'Error')
            })
    }
</script>
@endpush
