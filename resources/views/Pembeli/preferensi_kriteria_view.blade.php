@extends('Layouts.index')
@section('content')

<!-- Default Table -->
<h1>Hasil Pencarian</h1>
<br>
@if($items=="kosong")
<H3>Data tidak  ditemukan</H3>
@elseif($items!="kosong")
            <table class="table table-hover" id="contentDiv" >
              <thead>
                <tr>
                  <th scope="col">Nama Sepeda</th>
                  <th scope="col">Tipe</th>
                  <th scope="col">Toko</th>
                  <th scope="col">Merek</th>
                  @foreach($kriteria_all as $data)
                  <th scope="col">{{$data->nama_kriteria}}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                @foreach($items as $angka => $data)
                <tr>
                    @foreach($sepeda_all->where('id',$data["id"]) as $angka2 => $data2)
                    <td scope="row">{{$data2->nama_sepeda}}</td>
                    <td scope="row">{{$data2->tipe}}</td>
                    <td scope="row">{{$data2->toko->nama_toko}}</td>
                    <td scope="row">{{$data2->brand->nama_brand}}</td>
                    @endforeach
                    @foreach($kriteria_all as $data3)
                    <td scope="row">{{$data[$data3->nama_kriteria]}}</td>
                    @endforeach
                </tr>
                @endforeach
              </tbody>
            </table>
@endif
@endsection