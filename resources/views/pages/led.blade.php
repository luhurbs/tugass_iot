@extends('layouts.dashboard')

@section('title_menu', 'Led Control')

@section('content')
<style>
    body {
        background: linear-gradient(to bottom, #333, #6c757d);
        color: #fff;
    }

    .card {
        background-color: #f8f9fa;
    }

    .card-header {
        background-color: #ff0000;
        color: #fff;
    }

    .card-body {
        background-color: #fff;
        color: #000;
    }

    .led-icon {
        transition: color 0.3s;
    }

    .led-icon.on {
        color: #007bff;
    }

    .led-icon.off {
        color: #6c757d;
    }

    .custom-control-label::before, .custom-control-label::after {
        width: 2rem;
        height: 1rem;
    }

    .custom-control-label::after {
        left: 0.25rem;
    }

    .custom-switch .custom-control-input:checked~.custom-control-label::before {
        background-color: #007bff;
    }
</style>

<div class="card">
    <h5 class="card-header">LED Control</h5>
    <div class="card-body">
        <h5 class="card-title">
            <button style="background-color: #ff0000" type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                <i class="ri-add-line"></i>
                Tambah LED
            </button>
        </h5>
        <p class="card-text">
        <div class="row my-4">
            @foreach ($leds as $led)
            <div class="col-sm-6 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex w-100 justify-content-between">
                            <div class="d-flex align-items-start led-status
                                @if ($led->status == '1') text-primary @endif
                            ">
                                <i class="ri-lightbulb-line fa-fw fa-4x led-icon
                                    @if ($led->status == '1') on @else off @endif"></i>
                                <div>
                                    <h6 class="p-0 m-0 fw-bold">{{ $led->name }}</h6>
                                    <p class="p-0 m-0 text-muted">Pin: {{ $led->pin }}</p>
                                    <div>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input led-toggle"
                                                   id="customSwitch{{ $led->id }}" data-id="{{ $led->id }}"
                                                   @if ($led->status == '1') checked @endif>
                                            <label class="custom-control-label" for="customSwitch{{ $led->id }}"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                                <i class="ri-more-2-fill" type="button" data-toggle="dropdown" aria-expanded="false"></i>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Edit</a>
                                    <a class="dropdown-item" href="{{ route('leds.index') }}">Delete</a>
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
            @csrf
            <div class="modal-content">
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
                        <label for="pin">LED Pin</label>
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
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Tambahkan event listener pada checkbox status LED
        $('.led-toggle').change(function() {
            var ledId = $(this).data('id'); // Ambil ID LED
            var status = $(this).is(':checked') ? 1 : 0; // Dapatkan status baru (1 atau 0)
            var $icon = $(this).closest('.card').find('.led-icon');

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

                    // Perbarui ikon sesuai dengan status baru
                    if (status === 1) {
                        $icon.removeClass('off').addClass('on');
                    } else {
                        $icon.removeClass('on').addClass('off');
                    }
                },
                error: function(error) {
                    console.log('Error updating status', error);
                    // Revert switch state if there is an error
                    $(this).prop('checked', !status);
                }
            });
        });
    });
</script>
@endpush
