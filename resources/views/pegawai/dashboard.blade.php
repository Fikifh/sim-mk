@extends('admin_template')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Performa Bulanan</h3>
                            {{-- <a href="javascript:void(0);">View Report</a>
                            --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            {{-- <p class="d-flex flex-column">
                                <span class="text-bold text-lg">820</span>
                                <span>Visitors Over Time</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> 12.5%
                                </span>
                                <span class="text-muted">Since last week</span>
                            </p> --}}
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="visitors-chart" height="200" width="488" class="chartjs-render-monitor"
                                style="display: block; width: 488px; height: 200px;"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            {{-- <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> This Week
                            </span> --}}

                            {{-- <span>
                                <i class="fas fa-square text-gray"></i> Last Week
                            </span> --}}
                        </div>
                    </div>
                </div>                
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Performa Tahunan</h3>
                            {{-- <a href="javascript:void(0);">View Report</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                            {{-- <span class="text-bold text-lg">Rp. </span>
                                <span>Pendapatan Sepanjang Waktu</span>
                            </p> --}}
                            <p class="ml-auto d-flex flex-column text-right">
                                {{-- <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> 33.1%
                                </span>
                                <span class="text-muted">Since last month</span> --}}
                            </p>
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="sales-chart" height="200" style="display: block; width: 488px; height: 200px;"
                                width="488" class="chartjs-render-monitor"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            {{-- <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> This year
                            </span>

                            <span>
                                <i class="fas fa-square text-gray"></i> Last year
                            </span> --}}
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- /.col-md-6 -->
            <div class="col-12">
              <div class="card">
                  <div class="card-header">
                    <h3>Kesimpulan</h3>
                  </div>
                  <div class="card-body">
                    <p>
                        Berdasarkan Perolehan Penilaian yang sudah dilakukan anda mempunyai performa rata - rata <b> {{$kriteria ? $kriteria->nilai_text :  ''}}</b> dengan nilai capaian <b>{{round($summary->pra_nilai_capaian, 2)}}</b> dan nilai akhir <b>{{round($summary->nilai_capaian, 2)}}</b> serta nilai kehadiran rata - rata <b>{{round($summary->kehadiran, 2)}}</b>
                    </p>
                  </div>
              </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src={{ asset('bower_components/AdminLTE/plugins/chart.js/Chart.min.js') }}></script>
    <script src={{ asset('bower_components/AdminLTE/dist/js/demo.js') }}></script>
    <script>    
        
        $(document).ready(function() {
            'use strict'
            console.log('ada');
            
            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            }

            var mode = 'index'
            var intersect = true

            var $salesChart = $('#sales-chart')
            var salesChart = new Chart($salesChart, {
                type: 'bar',
                data: {
                    labels: {!!json_encode($year)!!},
                    datasets: [{
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            data: {!!json_encode($yearly_performance)!!},
                        },                        
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,

                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    if (value >= 1000) {
                                        value /= 1000
                                        value += 'k'
                                    }
                                    return value
                                }
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })

            var $visitorsChart = $('#visitors-chart')
            var visitorsChart = new Chart($visitorsChart, {
                data: {                                        
                    labels: {!!json_encode($month_names)!!},
                    datasets: [{
                            type: 'line',                            
                            data:  {!!json_encode($yearly_performance)!!},
                            backgroundColor: 'transparent',
                            borderColor: '#007bff',
                            pointBorderColor: '#007bff',
                            pointBackgroundColor: '#007bff',
                            fill: false
                            // pointHoverBackgroundColor: '#007bff',
                            // pointHoverBorderColor    : '#007bff'
                        },
                        // {
                        //     type: 'line',
                        //     data: [60, 80, 70, 67, 80, 77, 100],
                        //     backgroundColor: 'tansparent',
                        //     borderColor: '#ced4da',
                        //     pointBorderColor: '#ced4da',
                        //     pointBackgroundColor: '#ced4da',
                        //     fill: false
                        //     // pointHoverBackgroundColor: '#ced4da',
                        //     // pointHoverBorderColor    : '#ced4da'
                        // }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,
                                suggestedMax: 200
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
        })

    </script>
@endSection
