@extends('layouts.dashboard')

@section('title_menu', 'Led Control')

@section('content')
<<<<<<< HEAD
<style>
    body {
        background: linear-gradient(to bottom, #333, #6c757d);
        /* Gradient dari biru ke abu-abu */
        color: #fff;
        /* Warna teks putih */
    }

    .card {
        background-color: #f8f9fa;
        /* Warna latar belakang */
    }

    .card-header {
        background-color: #ff0000;
        /* Warna latar belakang header */
        color: #fff;
        /* Warna teks header */
    }

    .card-body {
        background-color: #fff;
        /* Warna latar belakang body */
        color: #000;
        /* Warna teks body */
    }
</style>
<div class="card">
    <h5 class="card-header">LED Control</h5>
    <div class="card-body">
        <h5 class="card-title"><button style="background-color: #ff0000" type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                <i class="ri-add-line"></i>
                Tambah LED
            </button></h5>
        <p class="card-text">
        <div class="row my-4">
            @foreach ($leds as $led)
            <div class="col-sm-6 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex w-100 justify-content-between">
                            <div class="d-flex align-items-start
                                    @if ($led->status == '1') text-primary @endif
                                    ">
                                <i class="ri-lightbulb-line fa-fw fa-4x"></i>
                                <div>
                                    <h6 class="p-0 m-0 fw-bold">{{ $led->name }}</h6>
                                    <p class="p-0 m-0 text-muted">Pin: {{ $led->pin }}</p>
                                    <div>
                                        <div class="custom-control custom-switch">
                                            <input @checked($led->status == '1') type="checkbox"
                                            class="custom-control-input" id="customSwitch{{ $led->id }}"
                                            data-pin="{{ $led->pin }}">
                                            <label class="custom-control-label" for="customSwitch{{ $led->id }}"></label>
                                        </div>
                                    </div>
=======
    <div class="card">
        <h5 class="card-header">LED Control</h5>
        <div class="card-body">
            {{-- <h5 class="card-title"><button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#staticBackdrop">
                    <i class="ri-add-line"></i>
                    Tambah LED
                </button></h5> --}}
            <p class="card-text">
            <div class="row my-4">
                @foreach ($leds as $led)
                    <div class="col-sm-6 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex w-100 justify-content-between">
                                    <div
                                        class="d-flex align-items-start
                                    @if ($led->status == '1') text-primary @endif
                                    ">
                                        <i class="ri-lightbulb-line fa-fw fa-4x"></i>
                                        <div>
                                            <h6 class="p-0 m-0 fw-bold">{{ $led->name }}</h6>
                                            <p class="p-0 m-0 text-muted">Pin: {{ $led->pin }}</p>
                                            <div>
                                                <div class="custom-control custom-switch">
                                                    {{-- <input @checked($led->status == '1') type="checkbox"
                                                        class="led- toggle custom-control-input" id="customSwitch{{ $led->id }}"
                                                        data-pin="{{ $led->pin }}">
                                                    <label class="custom-control-label"
                                                        for="customSwitch{{ $led->id }}">
                                                    </label> --}}

                                                    <input @checked($led->status == '1') class="led-toggle form-check-input"
                                                        data-id="{{ $led->id }}" type="checkbox"
                                                        id="led-switch-{{ $led->id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="dropdown">
                                        <i class="ri-more-2-fill" type="button" data-toggle="dropdown"
                                            aria-expanded="false"></i>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div> --}}

>>>>>>> ae2d5fff6bc20f1d5308ea3424630cde4e2d0678
                                </div>
                            </div>

                            <div class="dropdown">
                                <i class="ri-more-2-fill" type="button" data-toggle="dropdown" aria-expanded="false"></i>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="{{route('leds.index')}}">Delete</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        </p>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('leds.store') }}" method="POST">
            <div class="modal-content">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add LED</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">LED Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Nama LED">
                    </div>

                    <div class="form-group">
                        <label for="name">LED Pin</label>
                        <input type="number" class="form-control" name="pin" id="pin" placeholder="Pin">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Tambahkan event listener pada checkbox status LED
        $('.custom-control-input').change(function() {
            var ledId = $(this).attr('id').replace('customSwitch', ''); // Ambil ID LED
            var status = $(this).is(':checked') ? 1 : 0; // Dapatkan status baru (1 atau 0)

            // Kirim permintaan AJAX untuk memperbarui status LED
            $.ajax({
                url: '/leds/' + ledId, // URL endpoint update
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}', // Sertakan token CSRF
                    status: status
                },
                success: function(response) {
                    console.log('Status updated successfully');
                    // Anda bisa menambahkan notifikasi atau refresh sebagian halaman di sini
                },
                error: function(error) {
                    console.log('Error updating status', error);
                    // Anda bisa menampilkan pesan error ke pengguna di sini
                }
            });
        });
    });
</script>
@endsection

@push('scripts')
    <script>
        $('input.led-toggle').on('change', function() {
            const value = $(this).prop('checked') ? 1 : 0;
            const id = $(this).data('id');
            // mengirimkan data ke api
            let route = "{{ route('leds.update', ':id') }}";
            route = route.replace(':id', id);
            $.post(route, {
                    status: value,
                    _method: 'PUT',
                }, function(data) {
                    console.log(data);
                })
                .fail(function(err) {
                    $(this).prop('checked', !value);
                });
        });
    </script>
@endpush

led.blade.php
