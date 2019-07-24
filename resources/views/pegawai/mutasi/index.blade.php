@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
<div class="col-lg-4">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Tambah Mutasi</h5>
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
        <form action="{{route("mutasi_pegawai.add_action")}}" method="post" enctype="multipart/form-data">
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
            <label>Tanggal Mutasi</label>
            <input type="date" min="{{date("Y-m-d")}}" class="form-control" name="tgl_mutasi" placeholder="">
          </div>
          <div class="form-group">
            <label>Berkas</label>
            <input type="file" name="berkas" class="form-control-file">
          </div>
          <div class="form-group">
            <label>Asal</label>
            <input type="text" value="{{\App\Models\Pegawai::where(["nip"=>session()->get("nip")])->first()->sub_bagian->bagian->nama_divisi}} - {{\App\Models\Pegawai::where(["nip"=>session()->get("nip")])->first()->sub_bagian->nama_sub}}" class="form-control" disabled>
            <input type="text" name="asal" value="{{\App\Models\Pegawai::where(["nip"=>session()->get("nip")])->first()->id_sub_bagian}}" hidden>
          </div>
          <div class="form-group">
            <label>Tujuan</label>
            <select class="form-control" name="tujuan">
              @foreach(App\Models\SubBagian::all() as $k => $v)
              @if(\App\Models\Pegawai::where(["nip"=>session()->get("nip")])->first()->id_sub_bagian != $v->id_sub_bagian)
              <option value="{{$v->id_sub_bagian}}">{{$v->bagian->nama_divisi}} - {{$v->nama_sub}}</option>
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
      <h5 class="m-0">Data Mutasi</h5>
    </div>
    <div class="card-body">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table dt">
            <thead>
              <th>ID</th>
              <th>NIP</th>
              <th>Nama Pegawai</th>
              <th>Tanggal Mutasi</th>
              <th>Bagian Asal</th>
              <th>Bagian Tujuan</th>
              <th>Validasi Atasan</th>
              <th>Validasi Admin</th>
              <th>Berkas</th>
            </thead>
            <tbody>
              @foreach($mutasi as $k => $v)
              <tr>
                <td>{{$v->id_mutasi}}</td>
                <td>{{$v->nip}}</td>
                <td>{{$v->pegawai->nama_pegawai}}</td>
                <td>{{date("d-m-Y",strtotime($v->tgl_mutasi))}}</td>
                <td>{{$v->sub_bagian_asal->bagian->nama_divisi}} - {{$v->sub_bagian_asal->nama_sub}}</td>
                <td>{{$v->sub_bagian_tujuan->bagian->nama_divisi}} - {{$v->sub_bagian_tujuan->nama_sub}}</td>
                <td>
                  @if($v->status_validasi == "menunggu")
                  <span class="badge badge-warning">{{ucfirst($v->status_validasi)}}</span>
                  @elseif($v->status_validasi == "ditolak")
                  <span class="badge badge-danger">{{ucfirst($v->status_validasi)}}</span>
                  @elseif($v->status_validasi == "diijinkan")
                  <span class="badge badge-success">{{ucfirst($v->status_validasi)}}</span>
                  @endif
                </td>
                <td>
                  @if($v->status_mutasi == "menunggu")
                  <span class="badge badge-warning">{{ucfirst($v->status_mutasi)}}</span>
                  @elseif($v->status_mutasi == "ditolak")
                  <span class="badge badge-danger">{{ucfirst($v->status_mutasi)}}</span>
                  @elseif($v->status_mutasi == "disetujui")
                  <span class="badge badge-success">{{ucfirst($v->status_mutasi)}}</span>
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
@endsection
@section("js")
<script type="text/javascript">
  $(document).ready(function() {
    table = $(".dt").dataTable({});
  });
</script>
@endsection
