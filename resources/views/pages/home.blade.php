@extends('layouts.admin')


@section("activedashboard", "active")
@section("judul", "Dashboard")
@section('content')


<div class="card">
    <div class="card-header border-0">
        <div class="row">
            <div class="col-md-7">
                <h5 class="">Chart
                    {!! \Carbon\Carbon::parse($tanggal)->isoFormat('dddd, DD MMMM Y') !!}
                </h5>
            </div>
            <div class="col-md-5">
                <form action="{{ url()->current() }}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control" name="chart" onchange="submit()" style="border: none;border-bottom:1px solid lightgrey;padding: 10px 5px;height:40px">
                                <option value="bar" @if ($chart=="bar")
                                    selected
                                @endif>Bar</option>
                                <option value="pie" @if ($chart=="pie")
                                    selected
                                @endif>Pai</option>
                                <option value="line" @if ($chart=="line")
                                    selected
                                @endif>Line</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-9">

                            <input type="date" name="tanggal" class="form-control" value="{{ $tanggal }}" style="border: none;border-bottom:1px solid lightgrey;padding: 3px 5px;height:40px" id="" onchange="submit()">
                        </div>
                    </div>
                </form>
            </div>
        </div>




    </div>
    <div class="card-body">

        <div class="position-relative mb-4">
            <canvas id="sales-chart" style="max-height: 450px"></canvas>
        </div>

    </div>
</div>


@endsection


@section('myScript')

<script>
$(function () {
    'use strict'
    var mode = 'index'
    var intersect = true
    var $salesChart = $('#sales-chart')
    var salesChart = new Chart($salesChart, {
        type: '{!! $chart !!}',
        data: {
            labels: {!! $arrKategori !!},
            datasets: [
                {
                    @if ($chart=='bar')
                    backgroundColor: '#007bff',
                    @endif
                    borderColor: '#007bff',
                    data: {!! $arrJumlah !!}
                }
            ]
        },
        options: {
            indexAxis: 'y',
            scales: {
                x: {
                    stacked: true,
                    ticks: {
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                y: {
                    stacked: true,
                    ticks: {
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            }

        }
    })
})

</script>
@endsection
