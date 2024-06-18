@extends('layouts.admin')

@section("activekategori", "active")


@section("judul", "Data Kategori")

@section("content")

<div id="tambahkategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="_tambahkategori" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="_tambahkategori">Form Tambah Kategori</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('kategori.store', []) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namakategori">Nama Kategori</label>
                        <input id="namakategori" class="form-control" type="text" name="namakategori" placeholder="nama kategori">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="container">

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambahkategori">Tambah Kategori</button>

                </div>
                <div class="col-md-4">
                    <form action="{{ url()->current() }}">
                        <div class="input-group">
                            <input class="form-control" type="text" name="keyword" value="{{ $keyword }}" placeholder="search" aria-label="search" aria-describedby="keyword">
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
                        <th>Nama Kategori</th>
                        <th width="50px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($kategori as $item)
                        <tr>
                            <td ><center>{{ $loop->iteration + $kategori->firstItem() - 1 }}</center></td>
                            <td>{{ $item->namakategori }}</td>
                            <td nowrap>
                                <form action='{{ route('kategori.destroy', [$item->idkategori]) }}' method='post' class='d-inline'>
                                     @csrf
                                     @method('DELETE')
                                     <button type='submit' onclick="return confirm('Yakin ingin dihapus?')" class='badge badge-danger badge-btn border-0'>
                                         <i class="fa fa-trash"></i>
                                     </button>
                                </form>
                                <button class="badge badge-info badge-btn border-0" type="button" data-toggle="modal" data-target="#edit{{ $item->idkategori }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>
                            </td>
                        </tr>

                        <div id="edit{{ $item->idkategori }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="my-modal-title">Form Update</h5>
                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('kategori.update', [$item->idkategori]) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="namakategori">Text</label>
                                                <input id="namakategori" class="form-control" type="text" name="namakategori" value="{{ $item->namakategori }}">
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


            {{ $kategori->links("vendor.pagination.bootstrap-4") }}
        </div>
    </div>
</div>

@endsection
