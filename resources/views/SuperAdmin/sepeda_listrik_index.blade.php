@extends('Layouts.index')
@section('content')
<div class="container">
    <h1>List Brand</h1>
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
        @foreach($columns as $data =>$name)
      <th scope="col">{{$name}}</th>
      @endforeach
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    @foreach($index as $data)
      <th scope="row">{{$data->id}}</th>
      <td>{{$data->nama_sepeda}}</td>
      <td>{{$data->brand->nama_brand}}</td>
      <td>{{$data->toko->nama_toko}}</td>
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