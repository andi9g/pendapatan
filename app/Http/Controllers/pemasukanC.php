<?php

namespace App\Http\Controllers;

use App\Models\barangM;
use App\Models\kategoriM;
use App\Models\pemasukanM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pemasukanC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;
        $tanggal = empty($request->tanggal)?date('Y-m-d'):$request->tanggal;

        $kategori = kategoriM::get();

        $pemasukan = pemasukanM::whereHas("barang", function ($query) use ($keyword){
            $query->where("namabarang", "like", "%$keyword%")
            ->orWhere("kdbarang", "like", "$keyword%");
        })
        ->where("tanggal", $tanggal)
        ->orderBy("tanggal", "desc")
        ->paginate(15);

        $barang = barangM::get();

        $pemasukan->appends($request->only(["limit", "keyword", "tanggal"]));

        return view("pages.pemasukan", [
            "keyword" => $keyword,
            "pemasukan" => $pemasukan,
            "barang" => $barang,
            "kategori" => $kategori,
            "tanggal" => $tanggal,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'idbarang'=>'required',
            'tanggal'=>'required|date',
            'jumlahbarang'=>'required',
            'metodepembayaran'=>'required',
            'client'=>'required',
        ]);

        try{
            $data = $request->all();
            $data["iduser"] = Auth::user()->iduser;
            $idbarang = $request->idbarang;
            $barang = barangM::where("idbarang", $idbarang)->first();
            $data["hargabarang"] = $barang->hargabarang;
            pemasukanM::create($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
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
    public function update(Request $request, pemasukanM $pemasukanM, $idpemasukan)
    {
        $request->validate([
            'idbarang'=>'required',
            'tanggal'=>'required|date',
            'jumlahbarang'=>'required',
            'metodepembayaran'=>'required',
            'client'=>'required',
        ]);
        try{
            $data = $request->all();
            $data["iduser"] = Auth::user()->iduser;
            $idbarang = $request->idbarang;
            $barang = barangM::where("idbarang", $idbarang)->first();
            $data["hargabarang"] = $barang->hargabarang;
            pemasukanM::findOrFail($idpemasukan)->update($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemasukanM  $pemasukanM
     * @return \Illuminate\Http\Response
     */
    public function destroy(pemasukanM $pemasukanM, $idpemasukan)
    {
        try{
            pemasukanM::destroy($idpemasukan);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
