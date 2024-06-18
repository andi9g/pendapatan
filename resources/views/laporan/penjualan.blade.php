<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendapatan</title>
    <style>
        h1 {
            margin: 0;
            padding: 0;
        }
        h2 {
            margin: 0;
            padding: 0;
        }
        h3 {
            margin: 0;
            padding: 0;
        }
        h4 {
            margin: 0;
            padding: 0;
        }
        p {
            margin: 0;
            padding: 0;
        }

        table {
            border-collapse: collapse;

        }
    </style>
</head>
<body>
    <table width="100%" style="border-bottom: 2px solid darkgray;">
        <tr>
            <td valign="top" width="90px">
                <img src="{{ url('img/sentralprintz.png', []) }}" width="100%" alt="" style="padding-bottom: 5px;">
            </td>
            <td valign="middle" style="padding: 0px 10px">
                <h1>SENTRAL PRINTZ</h1>
                <h4>PUSAT CUSTOM MERCHANDISE TERLENGKAP!</h4>
                <p>Perum, Wedindra Regency Blok A No 10</p>
            </td>
        </tr>
    </table>

    <table style="margin: 10px 0px">
        <tr>
            <td>Tanggal Cetak</td>
            <td> : </td>
            <td>
                <small>
                    {!! \Carbon\Carbon::parse($tanggalawal)->isoFormat('dddd, DD MMMM Y') !!} s.d {!! \Carbon\Carbon::parse($tanggalakhir)->isoFormat('dddd, DD MMMM Y') !!}
                </small>
            </td>
        </tr>
    </table>

    <table border="1" width="100%">
        @php
            $total = 0;
        @endphp
        <thead>
            <tr>
                <th width="20px">No</th>
                <th width="100px">KD Barang</th>
                <th>Nama Barang</th>
                <th>Jml</th>
                <th>Harga Barang</th>
                <th>Total Harga</th>
                <th>Nama Pembeli</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pemasukan as $item)
                @php
                    $total = $total + ($item->jumlahbarang * $item->hargabarang);
                @endphp
                <tr>
                    <td ><center>{{ $loop->iteration  }}</center></td>
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

                </tr>



            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" align="center">
                    <h4>TOTAL PENDAPATAN</h4>
                </th>
                <th colspan="2">
                    <h3>
                        Rp{!! number_format($total, 0,",",'.')  !!}
                    </h3>
                </th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
