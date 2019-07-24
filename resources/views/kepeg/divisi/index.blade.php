@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Data Bagian</h5>
        <a href="{{route("divisi.add")}}" class="btn btn-success float-right">
          Tambah Bagian
        </a>
    </div>
    <div class="card-body">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table dt">
            <thead>
              <th>ID</th>
              <th>Nama Sub Bagian</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              @foreach($divisi as $k => $v)
              <tr>
                <td>{{$v->id_bagian}}</td>
                <td>{{$v->nama_divisi}}</td>
                <td>
                  <a href="{{route("divisi.del",$v->id_bagian)}}" class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                  </a>
                  <a href="{{route("divisi.detail",$v->id_bagian)}}" class="btn btn-success">
                    <i class="fa fa-plus"></i> Tambah Sub Bagian
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
