@extends('layouts.admin')

@section("activeharian", "active")
@section("activebarang", "active")


@section("judul", "Data barang")

@section("content")

<div id="tambahbarang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="_tambahbarang" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="_tambahbarang">Form Tambah barang</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('barang.store', []) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kdbarang">Kode Barang</label>
                        <input id="kdbarang" class="form-control" type="text" name="kdbarang" placeholder="masukan kdbarang">
                    </div>
                    <div class="form-group">
                        <label for="namabarang">Nama Barang</label>
                        <input id="namabarang" class="form-control" type="text" name="namabarang" placeholder="nama barang">
                    </div>
                    <div class="form-group">
                        <label for="hargabarang">Harga Barang</label>
                        <input id="hargabarang" class="form-control" type="number" name="hargabarang" placeholder="harga barang">
                    </div>
                    <div class='form-group'>
                        <label for='foridkategori' class='text-capitalize'>Kategori Barang</label>
                        <select name='idkategori' id='foridkategori' class='form-control select2' style="width:100%">
                            <option value=''>Pilih</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->idkategori }}">{{ $k->namakategori }}</option>
                            @endforeach
                        <select>
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
                <div class="col-md-8">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambahbarang">Tambah barang</button>

                </div>
                <div class="col-md-4">
                    <form action="{{ url()->current() }}">
                        <div class="input-group">
                            <input class="form-control" type="text" name="keyword" placeholder="search" value="{{ $keyword }}" aria-label="search" aria-describedby="keyword">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text bg-secondary text-light" id="keyword">Cari</button type="submit">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-hover table-striped table-bordered table-sm">
                <thead>
                    <tr>
                        <th width="20px">No</th>
                        <th width="100px">KdBarang</th>
                        <th>Nama barang</th>
                        <th>Harga Barang</th>
                        <th width="50px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($barang as $item)
                        <tr>
                            <td ><center>{{ $loop->iteration + $barang->firstItem() - 1 }}</center></td>
                            <td>{{ $item->kdbarang }}</td>
                            <td>{{ $item->namabarang }}</td>
                            <td>
                                Rp{{ number_format($item->hargabarang, 0,",",'.') }}
                            </td>
                            <td nowrap>
                                <form action='{{ route('barang.destroy', [$item->idbarang]) }}' method='post' class='d-inline'>
                                     @csrf
                                     @method('DELETE')
                                     <button type='submit' onclick="return confirm('Yakin ingin dihapus?')" class='badge badge-danger badge-btn border-0'>
                                         <i class="fa fa-trash"></i>
                                     </button>
                                </form>
                                <button class="badge badge-info badge-btn border-0" type="button" data-toggle="modal" data-target="#edit{{ $item->idbarang }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                            </td>
                        </tr>

                        <div id="edit{{ $item->idbarang }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="my-modal-title">Form Update</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('barang.update', [$item->idbarang]) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="kdbarang">Kode Barang</label>
                                                <input id="kdbarang" class="form-control" type="text" name="kdbarang" value="{{ $item->kdbarang }}" placeholder="masukan kdbarang">
                                            </div>
                                            <div class="form-group">
                                                <label for="namabarang">Nama Barang</label>
                                                <input id="namabarang" class="form-control" type="text" name="namabarang" value="{{ $item->namabarang }}" placeholder="nama barang">
                                            </div>
                                            <div class="form-group">
                                                <label for="hargabarang">Harga Barang</label>
                                                <input id="hargabarang" class="form-control" type="number" name="hargabarang" value="{{ $item->hargabarang }}" placeholder="harga barang">
                                            </div>
                                            <div class='form-group'>
                                                <label for='foridkategori' class='text-capitalize'>Kategori Barang</label>
                                                <select name='idkategori' id='foridkategori' class='form-control select2' style="width:100%">
                                                    <option value=''>Pilih</option>
                                                    @foreach ($kategori as $k)
                                                        <option value="{{ $k->idkategori }}" @if ($item->idkategori == $k->idkategori)
                                                            selected
                                                        @endif>{{ $k->namakategori }}</option>
                                                    @endforeach
                                                <select>
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
            {{ $barang->links("vendor.pagination.bootstrap-4") }}
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
