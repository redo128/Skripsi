@extends('Layouts.index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
<div class="card">
            <div class="card-body">
              <h5 class="card-title">Add New Kriteria</h5>
              <!-- General Form Elements -->
              <form method="POST" action="{{route('kriteriaperbandingan.store')}}">
                @csrf
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Kriteria</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_kriteria" class="form-control">
                  </div>
                </div>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit Form</button>
                  </div>
              </form><!-- End General Form Elements -->
            </div>
          </div>

        </div>
        </div>
    </div>
        </div>
@endsection