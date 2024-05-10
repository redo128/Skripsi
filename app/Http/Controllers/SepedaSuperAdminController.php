<?php

namespace App\Http\Controllers;

use App\Models\AlternatifValue;
use App\Models\Brand;
use App\Models\Kriteria;
use App\Models\SepedaListrik;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SepedaSuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $index = SepedaListrik::all();
        $kriteria= Kriteria::all();
        // $columns = DB::getSchemaBuilder()->getColumnListing('sepeda_listrik');
        $sepeda = AlternatifValue::all();
        return view('Superadmin.sepeda_listrik_index',compact('index','sepeda','kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $toko=Toko::all();
        $brand=Brand::all();
        $kriteria=Kriteria::all();
        return view('SuperAdmin.sepeda_listrik_create',compact('toko','brand','kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->get('harga'));
        $value = $request->input('value'); 

        //Inputan Sepeda listrik
        $sepeda=new SepedaListrik();
        $kriteria=Kriteria::all();
        $sepeda->nama_sepeda=$request->get('nama_sepeda');
        $sepeda->tipe=$request->get('tipe');
        $sepeda->toko_id=$request->get('toko_id');
        $sepeda->brand_id=$request->get('brand_id');
        $sepeda->save();
        // dd($sepeda->id);
        //Inputan Spesifikasi Sepeda Listrik
        foreach($kriteria as $loop){
            $speksifikasi=new AlternatifValue();
            $speksifikasi->kriteria_id=$loop->id;
            $speksifikasi->alternatif_id=$sepeda->id;
            if($loop->nama_kriteria=="harga"){
                $harga=str_replace(".", "", $value[$loop->nama_kriteria]);
                // dd($harga);
                $speksifikasi->value=$harga;
            }else{
            $speksifikasi->value=$value[$loop->nama_kriteria];
            }
            $speksifikasi->save();
        }
        
        return redirect()->route('sepeda_sa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=SepedaListrik::find($id);
        $toko=Toko::all();
        $brand=Brand::all();
        $value=AlternatifValue::where('alternatif_id',$id)->get();
        return view('Superadmin.sepeda_listrik_edit',compact('data','toko','brand','value'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sepeda=SepedaListrik::find($id);
        $sepeda->nama_sepeda=$request->get('nama_sepeda');
        $sepeda->tipe=$request->get('tipe');
        $sepeda->toko_id=$request->get('toko_id');
        $sepeda->brand_id=$request->get('brand_id');
        // $sepeda_value=AlternatifValue::where('alternatif_id',$id)->get();
        // dd($sepeda_value);
        $kriteria = $request->input('kriteria'); 
        // dd($kriteria);
        foreach($kriteria as $index => $loop_k){
            $sepeda_value=AlternatifValue::where('alternatif_id',$id)->where('kriteria_id',$index)->first();
            // dd($sepeda_value);
            $sepeda_value->value=$loop_k;
            $sepeda_value->save();

        }
        $sepeda->save();
        return redirect()->route('sepeda_sa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand=SepedaListrik::find($id);
        $brand->delete();
        return redirect()->route('sepeda_sa.index');
    }
}
