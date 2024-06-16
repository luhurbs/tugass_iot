@extends('layouts.dashboard')

@section('content')
    <style>
        body {
            background: linear-gradient(to bottom, #333, #6c757d);
            color: #fff;
            /* Warna teks putih */
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
            padding: 10px 20px;
        }

        .card-title {
            margin: 0;
            color: #DC143C;
        }

        .table-custom th,
        .table-custom td {
            text-align: center;
            vertical-align: middle;
        }

        .table-custom thead th {
            background-color: #6c757d;
            color: white;
        }
    </style>

    <div class="row my-2">
        <div class="col-sm-12 col-md-6">
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    <h4 class="card-title">Monitoring Sensor DHT11 - Suhu</h4>
                </div>
                <div class="card-body">
                    <div id="monitoringSuhu"></div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    <h4 class="card-title">Monitoring Sensor DHT11 - Kelembapan</h4>
                </div>
                <div class="card-body">
                    <div id="monitoringKelembapan"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-2">
        <div class="col-sm-12 col-md-6">
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    <h4 class="card-title">Monitoring Sensor Gas</h4>
                </div>
                <div class="card-body">
                    <div id="monitoringGas"></div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6">
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    <h4 class="card-title">Monitoring Sensor Hujan</h4>
                </div>
                <div class="card-body">
                    <div id="monitoringHujan"></div>
                    <div class="card mt-3">
                        <div class="card-header card-header-custom">
                            <h4 class="card-title">Rain</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="rain-table" class="table table-striped table-bordered table-custom">
                                    <thead>
                                        <tr>
                                            <th>Nilai</th>
                                            <th>Keterangan</th>
                                            <th>Created_at</th>
                                        </tr>
                                    </thead>
                                    <tbody id="rain-table-body">
                                        {{-- Data akan dimasukkan secara dinamis --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{{-- Suhu --}}
@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        let chartSuhu; // global

        async function requestDataSuhu() {
            try {
                const result = await fetch("{{ route('latest_dht11') }}"); // Ganti dengan URL endpoint API suhu Anda
                if (result.ok) {
                    const data = await result.json();
                    console.log(data);

                    // Pastikan data yang diterima sesuai dengan yang diharapkan
                    if (data.created_at && data.suhu) {
                        const date = new Date(data.created_at).getTime();
                        const value = parseFloat(data.suhu);

                        const point = [date, value];
                        const series = chartSuhu.series[0];
                        const shift = series.data.length > 20; // Shift if the series is longer than 20

                        // Add the point
                        chartSuhu.series[0].addPoint(point, true, shift);
                    } else {
                        console.error('Data format is incorrect', data);
                    }

                    // Call it again after five seconds
                    setTimeout(requestDataSuhu, 5000);
                } else {
                    console.error('Network response was not ok', result.statusText);
                }
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }

        // Initialize the chart when the window loads
        window.addEventListener('load', function() {
            chartSuhu = new Highcharts.Chart({
                chart: {
                    renderTo: 'monitoringSuhu',
                    type: 'spline',
                    events: {
                        load: requestDataSuhu // Start the data fetching when the chart is loaded
                    }
                },
                title: {
                    text: 'Suhu & Waktu'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000 // max zoom is 20 seconds
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Suhu (°C)',
                        margin: 80
                    }
                },
                series: [{
                    name: 'DHT 11',
                    data: []
                }]
            });
        });
    </script>
@endpush

{{-- Kelembapan --}}
@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        let chartKelembapan; // global

        async function requestDataKelembapan() {
            try {
                const result = await fetch("{{ route('latest_kelembapan') }}");
                if (result.ok) {
                    const data = await result.json();
                    console.log(data);

                    // Pastikan data yang diterima sesuai dengan yang diharapkan
                    if (data.created_at && data.kelembapan) {
                        const date = new Date(data.created_at).getTime();
                        const value = parseFloat(data.kelembapan);

                        const point = [date, value];
                        const series = chartKelembapan.series[0];
                        const shift = series.data.length > 20; // Shift if the series is longer than 20

                        // Add the point
                        chartKelembapan.series[0].addPoint(point, true, shift);
                    } else {
                        console.error('Data format is incorrect', data);
                    }

                    // Call it again after five seconds
                    setTimeout(requestDataKelembapan, 5000);
                } else {
                    console.error('Network response was not ok', result.statusText);
                }
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }

        // Initialize the chart when the window loads
        window.addEventListener('load', function() {
            chartKelembapan = new Highcharts.Chart({
                chart: {
                    renderTo: 'monitoringKelembapan',
                    type: 'spline',
                    events: {
                        load: requestDataKelembapan // Start the data fetching when the chart is loaded
                    }
                },
                title: {
                    text: 'Kelembapan & Waktu'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000 // max zoom is 20 seconds
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Kelembapan (%)',
                        margin: 80
                    }
                },
                series: [{
                    name: 'DHT 11',
                    data: []
                }]
            });
        });
    </script>
@endpush

{{-- MQ5 --}}
@push('scripts')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        let chartGas;

        async function requestDataGas() {
            try {
                const result = await fetch("{{ route('latest_mq5') }}");
                if (result.ok) {
                    const data = await result.json();
                    console.log(data);

                    // Pastikan data yang diterima sesuai dengan yang diharapkan
                    if (data.created_at && data.nilai_gas) {
                        const date = new Date(data.created_at).getTime();
                        const value = parseFloat(data.nilai_gas);

                        // Cek apakah nilai gas valid (misalnya tidak terlalu kecil atau besar, sesuaikan dengan kebutuhan)

                            const point = [date, value];
                            const series = chartGas.series[0];
                            const shift = series.data.length > 20; // Shift if the series is longer than 20

                            // Tambahkan titik data
                            chartGas.series[0].addPoint(point, true, shift);
                    } else {
                        console.error('Data format is incorrect', data);
                    }

                    // Panggil lagi setelah 5 detik
                    setTimeout(requestDataGas, 5000);
                } else {
                    console.error('Network response was not ok', result.statusText);
                }
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }

        // Mulai permintaan data saat halaman dimuat
        window.addEventListener('load', function() {
            chartGas = new Highcharts.Chart({
                    type: 'spline',
                    events: {
                        load: requestDataGas // Memanggil requestDataGas saat grafik dimuat
                    }
                },
                title: {
                    text: 'Gas & Waktu'
                },
                xAxis: {
                    type: 'datetime',
                    tickPixelInterval: 150,
                    maxZoom: 20 * 1000 // Zoom maksimum 20 detik
                },
                yAxis: {
                    minPadding: 0.2,
                    maxPadding: 0.2,
                    title: {
                        text: 'Gas (ppm)',
                        margin: 80
                    }
                },
                series: [{
                    name: 'MQ5',
                    data: [] // Data awal kosong, akan diisi oleh requestDataGas
                }]
            });
        });
    </script>
@endpush


{{-- Rain --}}
@push('scripts')
    <script>
        async function fetchRainData() {
            try {
                const response = await fetch("{{ route('latest_rain') }}");
                if (response.ok) {
                    const data = await response.json();
                    updateRainTable(data);
                } else {
                    console.error('Network response was not ok', response.statusText);
                }
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }

        function updateRainTable(data) {
            const tableBody = document.getElementById('rain-table-body');
            // Clear existing rows
            tableBody.innerHTML = '';

            // Insert new row
            const row = document.createElement('tr');
            row.innerHTML = `
            <td>${data.nilai_rain !== null ? data.nilai_rain : 'N/A'}</td>
            <td>${data.status}</td>
            <td>${data.created_at}</td>
        `;
            tableBody.appendChild(row);
        }

        // Fetch data every 3 seconds
        setInterval(fetchRainData, 3000);

        // Initial fetch
        fetchRainData();
    </script>
@endpush
