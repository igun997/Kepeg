@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
<div class="col-lg-6 offset-lg-3">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">{{$title}}</h5>
    </div>
    <div class="card-body">
      <div class="col-md-12">
        <form action="{{route("laporan.aksi")}}" method="post">
          @csrf
          <div class="form-group">
            <label>Jenis Laporan</label>
            <select class="form-control" name="jenis">
              <option value="pensiun">Pensiun</option>
              <option value="mutasi">Mutasi</option>
              <option value="kenaikan">Kenaikan</option>
              <option value="cuti">Cuti</option>
              <option value="pegawai">Pegawai</option>
            </select>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">
              Cetak
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

@endsection
