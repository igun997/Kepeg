@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
@if($status_umur)
<div class="col-lg-4">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Tambah Pensiun</h5>
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
        <form action="{{route("pensiun_pegawai.add_action")}}" method="post" enctype="multipart/form-data">
          @csrf
          @if(verify("level","admin"))
          <div class="form-group">
            <label>Pegawai</label>
            <select class="form-control" name="nip">
              @foreach(App\Models\Pegawai::where(["status_pegawai"=>"aktif"])->get() as $k => $v)
              <option value="{{$v->nip}}">{{$v->nama_pegawai}} - {{$v->nip}}</option>
              @endforeach
            </select>
          </div>
          @else
          <input type="text" name="nip" value="{{session()->get("nip")}}" hidden>
          @endif
          <div class="form-group">
            <label>Tanggal</label>
            <input type="date" min="{{date("Y-m-d")}}" class="form-control" name="tanggal" placeholder="">
          </div>
          <div class="form-group">
            <label>Berkas</label>
            <input type="file" name="berkas" class="form-control-file">
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" rows="3" class="form-control" cols="80"></textarea>
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
      <h5 class="m-0">Data Pensiun</h5>
    </div>
    <div class="card-body">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table dt">
            <thead>
              <th>ID</th>
              <th>NIP</th>
              <th>Nama Pegawai</th>
              <th>Tanggal Pensiun</th>
              <th>Keterangan</th>
              <th>Validasi Atasan</th>
              <th>Validasi Admin</th>
              <th>Berkas</th>
            </thead>
            <tbody>
              @foreach($pensiun as $k => $v)
              <tr>
                <td>{{$v->id_pensiun}}</td>
                <td>{{$v->nip}}</td>
                <td>{{$v->pegawai->nama_pegawai}}</td>
                <td>{{date("d-m-Y",strtotime($v->tanggal))}}</td>
                <td>{{$v->keterangan}}</td>
                <td>
                  @if($v->status == "menunggu")
                  <span class="badge badge-warning">{{ucfirst($v->status)}}</span>
                  @elseif($v->status == "ditolak")
                  <span class="badge badge-danger">{{ucfirst($v->status)}}</span>
                  @elseif($v->status == "disetujui")
                  <span class="badge badge-success">{{ucfirst($v->status)}}</span>
                  @endif
                </td>
                <td>
                  @if($v->status_pensiun == "menunggu")
                  <span class="badge badge-warning">{{ucfirst($v->status_pensiun)}}</span>
                  @elseif($v->status_pensiun == "ditolak")
                  <span class="badge badge-danger">{{ucfirst($v->status_pensiun)}}</span>
                  @elseif($v->status_pensiun == "disetujui")
                  <span class="badge badge-success">{{ucfirst($v->status_pensiun)}}</span>
                  @endif
                </td>
                <td>
                  <a href="{{url('upload/'.$v->berkas)}}" class="btn btn-success">
                    Berkas
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
@else
<div class="col-md-12">
  <div class="card">
    <div class="card-body">
      <div class="alert alert-info">
        Anda tidak dapat mengajukan pensiun
      </div>
    </div>
  </div>
</div>
@endif
@endsection
@section("js")
<script type="text/javascript">
  $(document).ready(function() {
    table = $(".dt").dataTable({});
  });
</script>
@endsection
