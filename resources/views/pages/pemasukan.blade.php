@extends('layouts.admin')

@section("activeharian", "active")
@section("activepemasukan", "active")


@section("judul", "Data Pemasukan")

@section("content")

<div id="tambahpemasukan" class="modal fade" tabindex="999" role="dialog" aria-labelledby="_tambahpemasukan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="_tambahpemasukan">Form Tambah pemasukan</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('pemasukan.store', []) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input id="tanggal" class="form-control" type="date" value="{{ $tanggal }}" name="tanggal" placeholder="masukan tanggal">
                    </div>

                    <div class='form-group'>
                        <label for='foridbarang' class='text-capitalize'>Data Barang</label>
                        <select name='idbarang' id='foridbarang' class='form-control select2' style="width:100%">
                            <option value=''>Pilih</option>
                            @foreach ($barang as $b)
                                <option value="{{ $b->idbarang }}">{{ $b->kdbarang." - ".$b->namabarang }}</option>
                            @endforeach
                        <select>
                    </div>

                    <div class="form-group">
                        <label for="jumlahbarang">Jumlah Barang</label>
                        <input id="jumlahbarang" class="form-control" type="number" value="1" name="jumlahbarang" placeholder="Jml barang">
                    </div>
                    <div class="form-group">
                        <label for="client">Nama Client</label>
                        <input id="client" class="form-control" type="text" value="" name="client" placeholder="Nama pembeli">
                    </div>

                    <div class="form-group">
                        <label for="metodepembayaran">Metode Pembayaran</label>
                        <select id="metodepembayaran" class="form-control" name="metodepembayaran">
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                            <option value="QRIS">QRIS</option>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>

            </form>
        </div>
    </div>
</div>


    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-5">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambahpemasukan">Tambah pemasukan</button>

                </div>
                <div class="col-md-7">
                    <form action="{{ url()->current() }}">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="tanggal" value="{{ $tanggal }}" onchange="submit()" id="" class="form-control">
                        </div>
                        <div class="col-md-7">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="keyword" placeholder="search" value="{{ $keyword }}" aria-label="search" aria-describedby="keyword">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text bg-secondary text-light" id="keyword">Cari</button type="submit">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="text-right">
                @php
                    // foreach ($pemasukan as $item) {
                        $jumlah = $item->sum("jumlahbarang");
                        $harga = $item->sum("hargabarang");
                    // }
                @endphp
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h5 class="">Hari/Tanggal :
                            {!! \Carbon\Carbon::parse($tanggal)->isoFormat('dddd, DD MMMM Y') !!}
                        </h5>
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-secondary">Pendapatan : Rp{{ number_format(($jumlah * $harga), 0, ",", ".") }}</h4>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th width="20px">No</th>
                            <th width="100px">KD Barang</th>
                            <th>Nama Barang</th>
                            <th>Jml</th>
                            <th>Harga Barang</th>
                            <th>Total Harga</th>
                            <th>Nama Pembeli</th>
                            <th width="50px">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pemasukan as $item)
                            <tr>
                                <td ><center>{{ $loop->iteration + $pemasukan->firstItem() - 1 }}</center></td>
                                <td class="text-center">{{ $item->barang->kdbarang }}</td>
                                <td>
                                    <center>
                                        <b>
                                            {{ $item->barang->namabarang }}
                                        </b>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        {{ $item->jumlahbarang }}
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        Rp{{ number_format($item->hargabarang, 0,",",'.') }}
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <b>
                                            Rp{{ number_format(($item->hargabarang*$item->jumlahbarang), 0,",",'.') }}
                                        </b>
                                    </center>
                                </td>
                                <td>
                                    {{ $item->client }}
                                </td>
                                <td nowrap>
                                    <form action='{{ route('pemasukan.destroy', [$item->idpemasukan]) }}' method='post' class='d-inline'>
                                         @csrf
                                         @method('DELETE')
                                         <button type='submit' onclick="return confirm('Yakin ingin dihapus?')" class='badge badge-danger badge-btn border-0'>
                                             <i class="fa fa-trash"></i>
                                         </button>
                                    </form>
                                    <button class="badge badge-info badge-btn border-0" type="button" data-toggle="modal" data-target="#edit{{ $item->idpemasukan }}">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                </td>
                            </tr>

                            <div id="edit{{ $item->idpemasukan }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="my-modal-title">Form Update</h5>
                                            <button class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('pemasukan.update', [$item->idpemasukan]) }}" method="POST">
                                            @csrf
                                            @method("PUT")
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="tanggal">Tanggal</label>
                                                    <input id="tanggal" class="form-control" type="date" value="{{ $item->tanggal }}" name="tanggal" placeholder="masukan tanggal">
                                                </div>

                                                <div class='form-group'>
                                                    <label for='foridbarang' class='text-capitalize'>Data Barang</label>
                                                    <select name='idbarang' id='foridbarang' class='form-control select2' style="width:100%">
                                                        <option value=''>Pilih</option>
                                                        @foreach ($barang as $b)
                                                            <option value="{{ $b->idbarang }}" @if ($b->idbarang == $item->idbarang)
                                                                selected
                                                            @endif>{{ $b->kdbarang." - ".$b->namabarang }}</option>
                                                        @endforeach
                                                    <select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="jumlahbarang">Jumlah Barang</label>
                                                    <input id="jumlahbarang" class="form-control" type="number" value="{{ $item->jumlahbarang }}" name="jumlahbarang" placeholder="Jml barang">
                                                </div>
                                                <div class="form-group">
                                                    <label for="client">Nama Client</label>
                                                    <input id="client" class="form-control" type="text" value="{{ $item->client }}" name="client" placeholder="Nama pembeli">
                                                </div>

                                                <div class="form-group">
                                                    <label for="metodepembayaran">Metode Pembayaran</label>
                                                    <select id="metodepembayaran" class="form-control" name="metodepembayaran">
                                                        <option value="cash" @if ($item->metodepembayaran == "cash")
                                                            selected
                                                        @endif>Cash</option>
                                                        <option value="transfer" @if ($item->metodepembayaran == "transfer")
                                                            selected
                                                        @endif>Transfer</option>
                                                        <option value="QRIS" @if ($item->metodepembayaran == "QRIS")
                                                            selected
                                                        @endif>QRIS</option>
                                                    </select>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">UPDATE</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>


                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $pemasukan->links("vendor.pagination.bootstrap-4") }}
        </div>
    </div>


@endsection



@section('myScript')
<script>
    $(document).ready(function() {
    function initializeSelect2(modal) {
        $(modal).find('.select2').select2({
            dropdownParent: $(modal)
        });
    }

    // Inisialisasi saat modal dibuka
    $('.modal').on('shown.bs.modal', function() {
        initializeSelect2(this);
    });

    // Jika Anda ingin menginisialisasi Select2 saat halaman dimuat juga (opsional)
    $('.modal').each(function() {
        initializeSelect2(this);
    });
});

</script>

@endsection
