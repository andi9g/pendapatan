<?php

namespace App\Http\Controllers;

use App\Models\barangM;
use App\Models\kategoriM;
use Illuminate\Http\Request;

class barangC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = empty($request->keyword)?'':$request->keyword;

        $kategori = kategoriM::get();

        $barang = barangM::where("namabarang", "like", "%$keyword%")
        ->orWhere("kdbarang", "like", "$keyword%")
        ->orderBy("namabarang", "asc")
        ->paginate(15);

        $barang->appends($request->only(["limit", "keyword"]));

        return view("pages.barang", [
            "keyword" => $keyword,
            "barang" => $barang,
            "kategori" => $kategori,
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
            'namabarang'=>'required',
            'idkategori'=>'required',
            'hargabarang'=>'required',
            'kdbarang'=>'required',
        ]);

        try{
            $data = $request->all();
            barangM::create($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barangM  $barangM
     * @return \Illuminate\Http\Response
     */
    public function show(barangM $barangM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barangM  $barangM
     * @return \Illuminate\Http\Response
     */
    public function edit(barangM $barangM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barangM  $barangM
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barangM $barangM ,$idbarang)
    {
        $request->validate([
            'namabarang'=>'required',
            'idkategori'=>'required',
            'hargabarang'=>'required',
            'kdbarang'=>'required',
        ]);
        try{
            $data = $request->all();
            barangM::findOrFail($idbarang)->update($data);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barangM  $barangM
     * @return \Illuminate\Http\Response
     */
    public function destroy(barangM $barangM, $idbarang)
    {
        try{
            barangM::destroy($idbarang);
            return redirect()->back()->with('success', 'Success');
        }catch(\Throwable $th){
            return redirect()->back()->with('toast_error', 'Terjadi kesalahan');
        }
    }
}
