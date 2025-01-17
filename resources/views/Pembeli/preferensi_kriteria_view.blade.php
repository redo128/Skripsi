@extends('Layouts.index')
@section('content')

<!-- Default Table -->
<h1>Hasil Pencarian</h1>
<br>
@if($items=="kosong")
<H3>Data tidak  ditemukan</H3>
@elseif($items!="kosong")
  @if($value_kriteria=="non")
            <table class="table table-hover" id="contentDiv" >
              <thead>
                <tr>
                  <th scope="col">Gambar Sepeda</th>
                  <th scope="col">Nama Sepeda</th>
                  <th scope="col">Tipe</th>
                  <th scope="col">Toko</th>
                  <th scope="col">Merek</th>
                  @foreach($kriteria_all as $data)
                  <th scope="col">{{$data->nama_kriteria}}</th>
                  @endforeach
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($items as $angka => $data)
                <tr>
                @foreach($sepeda_all->where('id',$data["id"]) as $angka2 => $data2)
                <td scope="row"><img src="{{asset('storage/'.$data2->image)}}" width="100px"  height="100px" alt=""></td>
                    <td scope="row">{{$data2->nama_sepeda}}</td>
                    <td scope="row">{{$data2->tipe}}</td>
                    <td scope="row">{{$data2->toko->nama_toko}}</td>
                    <td scope="row">{{$data2->brand->nama_brand}}</td>
                  @endforeach
                    @foreach($kriteria_all as $data3)
                    @if($data3->nama_kriteria == "kecepatan" )
                        <td scope="row"> {{number_format($data[$data3->nama_kriteria],0,",",".")}} KM/h</td>
                        @elseif($data3->nama_kriteria == "jarak tempuh")
                        <td scope="row"> {{number_format($data[$data3->nama_kriteria],0,",",".")}} KM</td>
                        @elseif($data3->nama_kriteria == "harga")
                        <td scope="row">  RP. {{number_format($data[$data3->nama_kriteria],0,",",".")}}</td>
                        @endif
                    @endforeach
                    <td scope="row">
                    <form method="POST" action="{{route('pembeli.custom.store',['data' => $data['id']])}}">
                    @csrf
                    @if($data_katalog->where("alternatif_id",$data["id"])->where("user_id",auth()->user()->id)->first()==null)
                      <button type="submit" class="btn btn-primary" title="Tambah Data">Tambah ke List</button>
                    @else
                    <button type="submit" class="btn btn-primary"  disabled>Telah ditambahkan</button>
                    @endif
                    </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
      @else
    <table class="table table-hover" id="contentDiv" >
              <thead>
                <tr>
                  <th scope="col">Gambar</th>
                  <th scope="col">Nama Sepeda</th>
                  <th scope="col">Tipe</th>
                  <th scope="col">Toko</th>
                  <th scope="col">Merek</th>
                  @foreach($kriteria_all as $data)
                  <th scope="col">{{$data->nama_kriteria}}</th>
                  @endforeach
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($items as $angka => $data)
                <tr>
                    @foreach($sepeda_all->where('id',$data["id"]) as $angka2 => $data2)
                    <td scope="row"><img src="{{asset('storage/'.$data2->image)}}" width="100px"  height="100px" alt=""></td>
                    <td scope="row">{{$data2->nama_sepeda}}</td>
                    <td scope="row">{{$data2->tipe}}</td>
                    <td scope="row">{{$data2->toko->nama_toko}}</td>
                    <td scope="row">{{$data2->brand->nama_brand}}</td>
                    @endforeach
                    @foreach($kriteria_all as $data3)
                        @if($data3->nama_kriteria == "kecepatan" )
                        <td scope="row"> {{number_format($data[$data3->nama_kriteria],0,",",".")}} KM/h</td>
                        @elseif($data3->nama_kriteria == "jarak tempuh")
                        <td scope="row"> {{number_format($data[$data3->nama_kriteria],0,",",".")}} KM</td>
                        @elseif($data3->nama_kriteria == "harga")
                        <td scope="row">  RP. {{number_format($data[$data3->nama_kriteria],0,",",".")}}</td>
                        @endif
                    @endforeach
                    <td scope="row">
                    <form method="POST" action="{{route('pembeli.custom.store',['data' => $data2->id])}}">
                    @csrf
                    @if($data_katalog->where("alternatif_id",$data2->id)->where("user_id",auth()->user()->id)->first()==null)
                      <button type="submit" class="btn btn-primary" title="Tambah Data">Tambah ke List</button>
                    @else
                    <button type="submit" class="btn btn-primary"  disabled>Telah ditambahkan</button>
                    @endif
                    </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @endif
@endif
@endsection