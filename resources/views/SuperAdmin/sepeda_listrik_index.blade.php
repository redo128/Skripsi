@extends('Layouts.index')
@section('content')
<div class="container">
    <h1>List Sepeda Listrik</h1>
    <div class="row">
        <div class="col-10">

        </div>
        <div class="col-2">
            <a href="{{route('sepeda_sa.create')}}"><button type="button" class="btn btn-primary">Tambah Data</button></a>
            <br><br>
        </div>

<table class="table">
  <thead>
    <tr>  
      <th scope="col">Image</th>
      <th scope="col">Nama Kendaraan</th>
      <th scope="col">Tipe</th>
      <th scope="col">Brand</th>
      <th scope="col">Toko</th>
      @foreach($kriteria as $a)
      <th scope="col">{{$a->nama_kriteria}}</th>
      @endforeach
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($index as $data)
    <tr>
      <th scope="row"><img src="{{asset('storage/'.$data->image)}}" class="img-thumbnail" style="width:100px" alt=""></th>
      <td>{{$data->nama_sepeda}}</td>
      <td>{{$data->tipe}}</td>
      <td>{{$data->brand->nama_brand}}</td>
      <td><a href="{{route('toko.show',$data->toko->id)}}">{{$data->toko->nama_toko}}</a></td> 
      @foreach($sepeda->where('alternatif_id',$data->id) as $data2)
      @if($data2->kriteria->nama_kriteria == "kecepatan" )
                                <td>{{number_format($data2->value,0,",",".")}} KM/h </td> 
                                @elseif($data2->kriteria->nama_kriteria == "jarak tempuh")
                                <td>{{number_format($data2->value,0,",",".")}} KM </td> 
                                @elseif($data2->kriteria->nama_kriteria == "harga" || $data2->kriteria->nama_kriteria == "biaya cas")
                                <td>RP. {{number_format($data2->value,0,",",".")}} </td>
                                @else
                                <td>{{$data2->value}}</td>
                                @endif
      @endforeach
      <td>
      <form action="{{ route('sepeda_sa.destroy', $data->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <a href="{{route('sepeda_sa.edit',$data->id)}}" class="btn btn-success">Edit</a>
    <button class="btn btn-danger" type="submit">Delete</button>
  </form>
  </td>
  </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
@endsection