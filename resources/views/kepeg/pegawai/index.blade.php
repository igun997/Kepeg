@extends("app.layout_kepeg")
@section("title",$title)
@section("content")

<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">
        Data Pegawai
        <a href="{{route("pegawai.add")}}" class="float-right btn btn-success">
          <i class="fa fa-plus"></i>
        </a>
      </h5>

    </div>
    <div class="card-body">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table dt">
            <thead>
              <th>NIP</th>
              <th>Nama</th>
              <th>Gol</th>
              <th>Bagian</th>
              <th>TTL</th>
              <th>JenKel</th>
              <th>No HP</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              @foreach($pegawai as $k => $v)
              <tr>
                <td>{{$v->nip}}</td>
                <td>{{$v->nama_pegawai}}</td>
                <td>{{$v->gol->nama_gol}}</td>
                <td>{{$v->sub_bagian->bagian->nama_divisi}} - {{$v->sub_bagian->nama_sub}}</td>
                <td>{{$v->tempat_lahir}},{{date("d-m-Y",strtotime($v->tgl_lahir))}}</td>
                <td>{{$v->jk}}</td>
                <td>{{$v->no_hp}}</td>
                <td>
                  <a href="{{route("pegawai.detail",$v->nip)}}" class="btn btn-success">
                    <i class="fa fa-search"></i>
                  </a>
                  <a href="{{route("pegawai.del",$v->nip)}}" class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                  </a>
                  <a href="{{route("pegawai.up",$v->nip)}}" class="btn btn-warning">
                    <i class="fa fa-edit"></i>
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
