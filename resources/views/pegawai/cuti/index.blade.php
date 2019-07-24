@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
<div class="col-lg-4">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Tambah Cuti</h5>
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
        <form action="{{route("cuti_pegawai.add_action")}}" method="post" enctype="multipart/form-data">
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
          <div class="form-group" id="saldo" style="display:none">
            <label>Saldo Cuti</label>
            <input type="number"  class="form-control" name="saldo_cuti" value="{{$saldo}}" readonly>
          </div>
          <div class="form-group">
            <label>Pilih Jenis Cuti</label>
            <select class="form-control" id="jenis">
              <option value="0">== Pilih ==</option>
              <option value="1">Tahunan</option>
              <option value="2">Sakit</option>
              <option value="3">Besar</option>
              <option value="4">Bersalin</option>
            </select>
          </div>
          <div class="form-group">
            <label>Tanggal Cuti</label>
            <input type="date"  class="form-control" name="tgl_cuti" min="{{date("Y-m-d")}}" placeholder="">
          </div>
          <div class="form-group">
            <label>Tanggal Selesai</label>
            <input type="date" class="form-control" name="tgl_selesai" min="{{date("Y-m-d")}}" placeholder="">
          </div>
          <div class="form-group">
            <label>Berkas</label>
            <input type="file" name="berkas" class="form-control" value="">
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="jns_cuti" id="jns_cuti" rows="8" class="form-control" cols="80"></textarea>
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
      <h5 class="m-0">Data Cuti</h5>
    </div>
    <div class="card-body">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table dt">
            <thead>
              <th>ID</th>
              <th>NIP</th>
              <th>Nama Pegawai</th>
              <th>Tanggal Cuti</th>
              <th>Tanggal Selesai</th>
              <th>Keterangan</th>
              <th>Validasi Atasan</th>
              <th>Validasi Admin</th>
              <th>Berkas</th>
            </thead>
            <tbody>
              @foreach($cuti as $k => $v)
              <tr>
                <td>{{$v->id_cuti}}</td>
                <td>{{$v->nip}}</td>
                <td>{{$v->pegawai->nama_pegawai}}</td>
                <td>{{date("d-m-Y",strtotime($v->tgl_cuti))}}</td>
                <td>{{date("d-m-Y",strtotime($v->tgl_selesai))}}</td>
                <td>{{$v->jns_cuti}}</td>
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
                  @if($v->status_cuti == "menunggu")
                  <span class="badge badge-warning">{{ucfirst($v->status_cuti)}}</span>
                  @elseif($v->status_cuti == "ditolak")
                  <span class="badge badge-danger">{{ucfirst($v->status_cuti)}}</span>
                  @elseif($v->status_cuti == "disetujui")
                  <span class="badge badge-success">{{ucfirst($v->status_cuti)}}</span>
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
    $("#jenis").on('change',function(event) {
      event.preventDefault();
      console.log("jenis");
      if ($(this).val() == 1) {
        $("#saldo").css('display', 'block');
        $("#jns_cuti").val("");
      }else if ($(this).val() == 2) {
        $("#jns_cuti").val("Cuti Khusus");
        $("#saldo").css('display', 'none');
      }else if ($(this).val() == 3) {
        $("#jns_cuti").val("Cuti Besar");
        $("#saldo").css('display', 'none');
      }else if ($(this).val() == 4) {
        $("#jns_cuti").val("Cuti Bersalin");
        $("#saldo").css('display', 'none');
      }else {
        $("#jns_cuti").val("");
        $("#saldo").css('display', 'none');
      }
    });
  });
</script>
@endsection
