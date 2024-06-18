@extends('layouts.admin')

@section("activelaporan", "active")

@section("judul", "LAPORAN")

@section("content")



<div class="container">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">FORM LAPORAN</h3>
        </div>

        <form action="{{ route('cetak.laporan', []) }}" method="get">
            <div class="card-body">
                <div class="form-group">
                    <label for="tanggalawal">Tanggal Awal</label>
                    <input id="tanggalawal" class="form-control" type="date" name="tanggalawal">
                </div>
                <div class="form-group">
                    <label for="tanggalakhir">Tanggal Akhir</label>
                    <input id="tanggalakhir" class="form-control" type="date" name="tanggalakhir">
                </div>

            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success px-4">
                    <i class="fa fa-print"></i> CETAK
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
