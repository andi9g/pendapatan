<?php

namespace App\Http\Controllers;

use App\Models\kategoriM;
use App\Models\pemasukanM;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $tanggal = empty($request->tanggal)?date("Y-m-d"):$request->tanggal;
        $chart = empty($request->chart)?'bar':$request->chart;
        $kategori = kategoriM::get();
        $arrKategori = [];
        $jml = 0;
        $arrJumlah = [];
        foreach ($kategori as $k) {
            $arrKategori[] = $k->namakategori;
            $pemasukan = pemasukanM::where("tanggal", $tanggal)
            ->whereHas("barang", function ($query) use ($k) {
                $query->where("idkategori", $k->idkategori);
            })
            ->count();


            $arrJumlah[] = (int) $pemasukan;
        }

        $total = pemasukanM::has('barang')
        ->where("tanggal", $tanggal)
        ->selectRaw("hargabarang * jumlahbarang as total")
        ->selectRaw("jumlahbarang")->get();
        // dd($total);

        $arrJumlah = json_encode($arrJumlah);
        $arrKategori = json_encode($arrKategori);

        return view('pages.home', [
            "arrJumlah" => $arrJumlah,
            "arrKategori" => $arrKategori,
            "tanggal" => $tanggal,
            "chart" => $chart,
            "total" => $total,
        ]);
    }
}
