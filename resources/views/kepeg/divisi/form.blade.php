@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
<div class="col-lg-6 offset-3">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Tambah Bagian</h5>
    </div>
    <div class="card-body">
      <div class="col-12">
        @if(session()->has("msg"))
        <div class="alert alert-success">{{session()->get("msg")}}</div>
        @endif
        @if($errors->has(null))
        <div class="alert alert-danger">
           @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
          @endforeach
        </div>
        @endif
        <form action="{{route("divisi.add_action")}}" method="post">
          @csrf
          <div class="form-group">
            <label>Nama Bagian</label>
            <input type="text" class="form-control" name="nama_divisi" placeholder="">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
