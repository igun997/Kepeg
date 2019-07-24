@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
<div class="col-lg-6">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Tambah Divisi</h5>
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
            <label>Nama Divisi</label>
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
<div class="col-lg-6">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Data Divisi</h5>
    </div>
    <div class="card-body">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table dt">
            <thead>
              <th>ID</th>
              <th>Nama Divisi</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              @foreach($divisi as $k => $v)
              <tr>
                <td>{{$v->id_divisi}}</td>
                <td>{{$v->nama_divisi}}</td>
                <td>
                  <a href="{{route("divisi.del",$v->id_divisi)}}" class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section("js")
<script type="text/javascript">
  $(document).ready(function() {
    table = $(".dt").dataTable({});
  });
</script>
@endsection
