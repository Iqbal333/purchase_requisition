@extends('layouts.app')
@section('content')

<section class="row">
    <div class="col-12 col-lg-9">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Grafik Permintaan Barang</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-3">
        <div class="card">
            <div class="card-body py-4 px-4">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-xl">
                        <img src="assets/images/faces/1.jpg" alt="Face 1">
                    </div>
                    <div class="ms-3 name">
                        <h5 class="font-bold">{{ auth()->user()->name }}</h5>
                        <h6 class="text-muted mb-0">{{ auth()->user()->email }}</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Visitors Profile</h4>
            </div>
            <div class="card-body">
                <div id="chart-visitors-profile"></div>
                {{-- <div id="pie"></div> --}}
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

        let departureChart = new Chart(document.getElementById('departureChart').getContext('2d'), {
            type: 'pie',
            data: {
                datasets: [{
                    data: [0, 0],
                    backgroundColor: [
                        '#421C52',
                        'yellow',
                    ],
                }],
                labels: ['AKAP', 'AKDP']
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
            url: `/departure`,
            type: 'GET',
            dataType: 'JSON',
            success: ({ results }) => {
                if (results.length !== 0){
                    results.forEach(v => {
                        let index

                        if(v.departure === 'Akap')
                            index = 0;
                        else if (v.departure === 'Akdp')
                            index = 1;
                        departureChart.data.datasets[0].data[index] = v.totalDeparture
                    })
                }

                departureChart.update()
            },
            error: err => {

            },
            complete: () => {

            }
        })

    </script>
@endsection
