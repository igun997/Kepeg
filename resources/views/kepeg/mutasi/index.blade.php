@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
@if(verify("level","atasan"))
<div class="col-lg-12">
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
              <th>Status</th>
              <th>Aksi</th>
              <th>Berkas</th>
            </thead>
            <tbody>
              @foreach($mutasiAtasan as $k => $v)
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
                  @if($v->status_validasi == "menunggu")
                  <a href="{{route("mutasi.up_action",[$v->id_mutasi,"diijinkan"])}}" class="btn btn-success">
                    <i class="fa fa-check"></i>
                  </a>
                  <a href="{{route("mutasi.up_action",[$v->id_mutasi,"ditolak"])}}" class="btn btn-danger">
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
              <th>Verifikasi Atasan</th>
              <th>Verifikasi Admin</th>
              <th>Berkas</th>
              <th>Aksi</th>
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
                <td>
                  @if($v->status_mutasi == "menunggu")
                  <a href="{{route("mutasi.up_action_admin",[$v->id_mutasi,"disetujui"])}}" class="btn btn-success">
                    <i class="fa fa-check"></i>
                  </a>
                  <a href="{{route("mutasi.up_action_admin",[$v->id_mutasi,"ditolak"])}}" class="btn btn-danger">
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
