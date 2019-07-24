@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
@if(verify("level","atasan"))
<div class="col-lg-12">
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
              <th>Status</th>
              <th>Aksi</th>
              <th>Berkas</th>
            </thead>
            <tbody>
              @foreach($pensiunAtasan as $k => $v)
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
                  @if($v->status == "menunggu")
                  <a href="{{route("pensiun.up_action",[$v->id_pensiun,"disetujui"])}}" class="btn btn-success">
                    <i class="fa fa-check"></i>
                  </a>
                  <a href="{{route("pensiun.up_action",[$v->id_pensiun,"ditolak"])}}" class="btn btn-danger">
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
              <th>Aksi</th>
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
                <td>
                  @if($v->status_pensiun == "menunggu")
                  <a href="{{route("pensiun.up_action_admin",[$v->id_pensiun,"disetujui"])}}" class="btn btn-success">
                    <i class="fa fa-check"></i>
                  </a>
                  <a href="{{route("pensiun.up_action_admin",[$v->id_pensiun,"ditolak"])}}" class="btn btn-danger">
                    <i class="fa fa-ban"></i>
                  </a>
                  @endif
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
