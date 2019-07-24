@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
<div class="col-lg-4">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Tambah Golongan</h5>
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
        <form action="{{route("gol.add_action")}}" method="post">
          @csrf
          <div class="form-group">
            <label>Nama Golongan</label>
            <input type="text" class="form-control" name="nama_gol" placeholder="">
          </div>
          <div class="form-group">
            <label>Pangkat</label>
            <input type="text" class="form-control" name="pangkat" placeholder="">
          </div>
          <div class="form-group">
            <label>Gaji Pokok</label>
            <input type="number" class="form-control" name="gaji_pokok" placeholder="">
          </div>
          <div class="form-group">
            <label>Tunjangan Kerja</label>
            <input type="number" class="form-control" name="tunj_kerja" placeholder="">
          </div>
          <div class="form-group">
            <label>Tunjangan Istri</label>
            <input type="number" class="form-control" name="tunj_istri" placeholder="">
          </div>
          <div class="form-group">
            <label>Tunjangan Anak</label>
            <input type="number" class="form-control" name="tunj_anak" placeholder="">
          </div>
          <div class="form-group">
            <label>Tunjangan Umum</label>
            <input type="number" class="form-control" name="tunj_umum" placeholder="">
          </div>
          <div class="form-group">
            <label>Tunjangan Lain</label>
            <input type="number" class="form-control" name="tunj_lain" placeholder="">
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
<div class="col-lg-8">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Data Golongan</h5>
    </div>
    <div class="card-body">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table dt">
            <thead>
              <th>ID</th>
              <th>Nama Golongan</th>
              <th>Pangkat</th>
              <th>Gaji Pokok</th>
              <th>Tunjangan Kerja</th>
              <th>Tunjangan Istri</th>
              <th>Tunjangan Anak</th>
              <th>Tunjangan Umum</th>
              <th>Tunjangan Lain</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              @foreach($gol as $k => $v)
              <tr>
                <td>{{$v->id_gol}}</td>
                <td>{{$v->nama_gol}}</td>
                <td>{{$v->pangkat}}</td>
                <td>{{$v->gaji_pokok}}</td>
                <td>{{$v->tunj_kerja}}</td>
                <td>{{$v->tunj_istri}}</td>
                <td>{{$v->tunj_anak}}</td>
                <td>{{$v->tunj_umum}}</td>
                <td>{{$v->tunj_lain}}</td>
                <td>
                  <a href="{{route("gol.del",$v->id_gol)}}" class="btn btn-danger">
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
