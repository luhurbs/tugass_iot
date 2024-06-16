@extends('layouts.dashboard')

@section('content')
    <style>
        body {
            background: linear-gradient(to bottom, #333, #6c757d); /* Gradient dari biru ke abu-abu */
            color: #fff; /* Warna teks putih */
        }
        .card-custom {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .card-custom:hover {
            transform: translateY(-10px);
        }

        .card-header-custom {
            background-color: #333;
            color: white;
            border-bottom: 2px solid #0056b3;
            border-radius: 10px 10px 0 0;
        }

        .table-custom th, .table-custom td {
            text-align: center;
            vertical-align: middle;
        }

        .table-custom thead th {
            background-color: #6c757d;
            color: white;
        }

        .badge-custom {
            background-color: #17a2b8;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .card-title {
            font-weight: bold;
            color: #DC143C;
        }
    </style>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card card-custom">
                <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">DHT 11</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-custom">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Suhu</th>
                                    <th>Kelembapan</th>
                                    <th>Created_at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dht11 as $sensor)
                                    <tr>
                                        <td>{{ $sensor['id'] }}</td>
                                        <td>{{ $sensor['name'] }}</td>
                                        <td>{{ $sensor['suhu'] }}</td>
                                        <td>{{ $sensor['kelembapan'] }}</td>
                                        <td>{{ $sensor->created_at->format('d M Y, H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-4">
            <div class="card card-custom">
                <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">MQ-5</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-custom">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Nilai Gas</th>
                                    <th>Created_at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mq5 as $sensor)
                                    <tr>
                                        <td>{{ $sensor['id'] }}</td>
                                        <td>{{ $sensor['name'] }}</td>
                                        <td>{{ $sensor['nilai_gas'] }}</td>
                                        <td>{{ $sensor->created_at->format('d M Y, H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-4">
            <div class="card card-custom">
                <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Rain Sensor</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-custom">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Nilai Hujan</th>
                                    <th>Created_at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rain as $sensor)
                                    <tr>
                                        <td>{{ $sensor['id'] }}</td>
                                        <td>{{ $sensor['name'] }}</td>
                                        <td>{{ $sensor['nilai_rain'] }}</td>
                                        <td>{{ $sensor->created_at->format('d M Y, H:i:s') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
