@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
@if($status_umur)
<div class="col-lg-4">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Tambah Kenaikan Golongan</h5>
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
        <form action="{{route("kenaikan_pegawai.add_action")}}" method="post" enctype="multipart/form-data">
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
            <label>Tanggal Kenaikan Golongan</label>
            <input type="date" min="{{date("Y-m-d")}}" class="form-control" name="tanggal" placeholder="">
          </div>
          <input type="text" name="jenis" hidden value="struktural">
          <div class="form-group">
            <label>Berkas</label>
            <input type="file" name="berkas" class="form-control-file">
          </div>
          <div class="form-group">
            <label>Asal</label>
            <input type="text" value="{{\App\Models\Pegawai::where(["nip"=>session()->get("nip")])->first()->gol->nama_gol}}" class="form-control" disabled>
            <input type="text" name="asal" value="{{\App\Models\Pegawai::where(["nip"=>session()->get("nip")])->first()->id_gol}}" hidden>
          </div>
          <div class="form-group">
            <label>Tujuan</label>
            <select class="form-control" name="tujuan">
              @foreach(App\Models\Gol::all() as $k => $v)
              @if(\App\Models\Pegawai::where(["nip"=>session()->get("nip")])->first()->id_gol != $v->id_gol)
              <option value="{{$v->id_gol}}">{{$v->nama_gol}}</option>
              @endif
              @endforeach
            </select>
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
      <h5 class="m-0">Data Kenaikan Golongan</h5>
    </div>
    <div class="card-body">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table dt">
            <thead>
              <th>ID</th>
              <th>NIP</th>
              <th>Nama Pegawai</th>
              <th>Tanggal Kenaikan Golongan</th>
              <th>Golongan Asal</th>
              <th>Golongan Tujuan</th>
              <th>Validasi Atasan</th>
              <th>Validasi Admin</th>
              <th>Berkas</th>
            </thead>
            <tbody>
              @foreach($kenaikan as $k => $v)
              <tr>
                <td>{{$v->id_kenaikan}}</td>
                <td>{{$v->nip}}</td>
                <td>{{$v->pegawai->nama_pegawai}}</td>
                <td>{{date("d-m-Y",strtotime($v->tanggal))}}</td>
                <td>{{$v->gol_asal->nama_gol}}</td>
                <td>{{$v->gol_tujuan->nama_gol}}</td>
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
                  @if($v->status_kenaikan == "menunggu")
                  <span class="badge badge-warning">{{ucfirst($v->status_kenaikan)}}</span>
                  @elseif($v->status_kenaikan == "ditolak")
                  <span class="badge badge-danger">{{ucfirst($v->status_kenaikan)}}</span>
                  @elseif($v->status_kenaikan == "disetujui")
                  <span class="badge badge-success">{{ucfirst($v->status_kenaikan)}}</span>
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
        Anda tidak dapat mengajukan kenaikan golongan
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
