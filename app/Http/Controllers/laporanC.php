<?php

namespace App\Http\Controllers;

use App\Models\pemasukanM;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class laporanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("pages.laporan");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cetak(Request $request)
    {
        // try{
            $tanggalawal = $request->tanggalawal;
            $tanggalakhir = $request->tanggalakhir;

            $pemasukan = pemasukanM::whereBetween("tanggal", [$tanggalawal, $tanggalakhir])
            ->orderBy("tanggal", "desc")
            ->get();

            $pdf = PDF::loadView("laporan.penjualan", [
                "tanggalawal" => $tanggalawal,
                "tanggalakhir" => $tanggalakhir,
                "pemasukan" => $pemasukan,
            ]);

            return $pdf->stream("pendapatan.pdf");

        // }catch(\Throwable $th){
        //     return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pemasukanM  $pemasukanM
     * @return \Illuminate\Http\Response
     */
    public function show(pemasukanM $pemasukanM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pemasukanM  $pemasukanM
     * @return \Illuminate\Http\Response
     */
    public function edit(pemasukanM $pemasukanM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pemasukanM  $pemasukanM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pemasukanM $pemasukanM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemasukanM  $pemasukanM
     * @return \Illuminate\Http\Response
     */
    public function destroy(pemasukanM $pemasukanM)
    {
        //
    }
}
