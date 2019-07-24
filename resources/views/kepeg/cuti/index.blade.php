@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
@if(verify("level","atasan"))
<div class="col-lg-12">
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
              <th>Status</th>
              <th>Aksi</th>
              <th>Berkas</th>
            </thead>
            <tbody>
              @foreach($cutiAtasan as $k => $v)
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
                  @if($v->status == "menunggu")
                  <a href="{{route("cuti.up_action",[$v->id_cuti,"disetujui"])}}" class="btn btn-success">
                    <i class="fa fa-check"></i>
                  </a>
                  <a href="{{route("cuti.up_action",[$v->id_cuti,"ditolak"])}}" class="btn btn-danger">
                    <i class="fa fa-ban"></i>
                  </a>
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
<div class="col-lg-12">
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
              <th>Aksi</th>
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
                  @if($v->status_cuti == "menunggu")
                  <a href="{{route("cuti.up_action_admin",[$v->id_cuti,"disetujui"])}}" class="btn btn-success">
                    <i class="fa fa-check"></i>
                  </a>
                  <a href="{{route("cuti.up_action_admin",[$v->id_cuti,"ditolak"])}}" class="btn btn-danger">
                    <i class="fa fa-ban"></i>
                  </a>
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
@endif
@endsection
@section("js")
<script type="text/javascript">
  $(document).ready(function() {
    table = $(".dt").dataTable({});
  });
</script>
@endsection
