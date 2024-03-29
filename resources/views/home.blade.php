@extends('layouts.app')
@section('content')

<section class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon purple mb-2">
                                    <i class="iconly-boldShow"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Request Item</h6>
                                <h6 class="font-extrabold mb-0">{{ $request_items}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon blue mb-2">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Users</h6>
                                <h6 class="font-extrabold mb-0">{{ $user }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon green mb-2">
                                    <i class="iconly-boldAdd-User"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Division</h6>
                                <h6 class="font-extrabold mb-0">{{ $division }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body px-4 py-4-5">
                        <div class="row">
                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                <div class="stats-icon red mb-2">
                                    <i class="iconly-boldBookmark"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="text-muted font-semibold">Total Pending</h6>
                                <h6 class="font-extrabold mb-0">{{ $total_request_pending }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Grafik Permintaan Barang</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="135"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Grafik Status Permintaan</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart" height="65"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

@endsection

@section('grafik')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            responsive:false,
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                    label: 'Grafik Permintaan Barang',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                    backgroundColor: [
                        'rgba(78, 115, 223, 0.05)'
                    ],
                    borderColor: [
                        'rgba(78, 115, 223, 1)'
                    ],
                }]
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                        }
                    }]
                }
            }
        });

        let pieChart = new Chart(document.getElementById('pieChart').getContext('2d'), {
            type: 'pie',
            data: {
                datasets: [{
                    data: [0, 0, 0],
                    backgroundColor: [
                        'green',
                        'red',
                        '#ffc107',
                    ],
                }],
                labels: ['Approve', 'Reject', 'Pending']
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });

        $.ajax({
            url: `/engagement`,
            type: 'GET',
            dataType: 'JSON',
            success: ({ results }) => {
                console.log(results);
                if (results.length !== 0){
                    results.forEach(v => {
                        myChart.data.datasets[0].data[v.monthKey -1] = v.totalRequestItem
                    })
                }

                myChart.update()
            },
            error: err => {

            },
            complete: () => {

            }
        })

        $.ajax({
            url: `/status_request`,
            type: 'GET',
            dataType: 'JSON',
            success: ({ results }) => {
                if (results.length !== 0){
                    let status = results.map(v => v.totalStatus)

                    pieChart.data.datasets[0].data = status
                }

                pieChart.update()
            },
            error: err => {

            },
            complete: () => {

            }
        })

    </script>
@endsection
