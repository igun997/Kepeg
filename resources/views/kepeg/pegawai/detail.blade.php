@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
<div class="col-lg-12">
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
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5 class="m-0">Tambah Riwayat Pendidikan</h5>
        </div>
        <div class="card-body">
          <div class="col-12">
            <form action="{{route("pegawai.add_action_riwayat",["pendidikan",$id])}}" method="post">
              @csrf
              <div class="form-group">
                <label>Tingak Pendidikan</label>
                <select class="form-control" name="tingkat_pend">
                  <option value="SD">{{strtoupper("SD")}}</option>
                  <option value="SMP">{{strtoupper("SMP")}}</option>
                  <option value="SMA">{{strtoupper("SMA")}}</option>
                  <option value="S1">{{strtoupper("S1")}}</option>
                  <option value="S2">{{strtoupper("S2")}}</option>
                  <option value="S3">{{strtoupper("S3")}}</option>
                </select>
              </div>
              <div class="form-group">
                <label>Nama Sekolah</label>
                <input type="text" class="form-control" name="nama_sekolah">
              </div>
              <div class="form-group">
                <label>Bulan Lulus</label>
                <input type="number" max="12" min="1" class="form-control" name="bulan_lulus">
              </div>
              <div class="form-group">
                <label>Tahun Lulus</label>
                <input type="number" max="{{date("Y")}}" min="1900" class="form-control" name="tahun_lulus">
              </div>
              <div class="form-group">
                <button type="submit" class="btn-block btn btn-success">
                  Simpan
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5 class="m-0">Tambah Riwayat Diklat</h5>
        </div>
        <div class="card-body">
          <div class="col-12">
            <form action="{{route("pegawai.add_action_riwayat",["diklat",$id])}}" method="post">
              @csrf

              <div class="form-group">
                <label>Nama Diklat</label>
                <input type="text" class="form-control" name="nama_diklat">
              </div>
              <div class="form-group">
                <label>Bulan Lulus</label>
                <input type="number" max="12" min="1" class="form-control" name="bulan">
              </div>
              <div class="form-group">
                <label>Tahun Lulus</label>
                <input type="number" max="{{date("Y")}}" class="form-control" name="tahun">
              </div>
              <div class="form-group">
                <button type="submit" class="btn-block btn btn-success">
                  Simpan
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5 class="m-0">Data Riwayat Pendidikan</h5>
        </div>
        <div class="card-body">
          <div class="col-12">
            <div class="table-responsive">
              <table class="table dt">
                <thead>
                  <th>No</th>
                  <th>Tingkat Pendidikan</th>
                  <th>Nama Sekolah</th>
                  <th>Lulus</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  @foreach($pegawai_pendidikans as $k => $v)
                  <tr>
                    <td>{{$k+1}}</td>
                    <td>{{$v->tingkat_pend}}</td>
                    <td>{{$v->nama_sekolah}}</td>
                    <td>{{$v->bulan_lulus}}/{{$v->tahun_lulus}}</td>
                    <td>
                      <a href="{{route("pegawai.del_riwayat",[$v->id_pp,"pendidikan"])}}" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
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
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h5 class="m-0">Data Riwayat Diklat</h5>
        </div>
        <div class="card-body">
          <div class="col-12">
            <div class="table-responsive">
              <table class="table dt">
                <thead>
                  <th>No</th>
                  <th>Nama Diklat</th>
                  <th>Lulus</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  @foreach($pegawai_diklats as $k => $v)
                  <tr>
                    <td>{{$k+1}}</td>
                    <td>{{$v->nama_diklat}}</td>
                    <td>{{$v->bulan}}/{{$v->tahun}}</td>
                    <td>
                      <a href="{{route("pegawai.del_riwayat",[$v->id_pd,"diklat"])}}" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
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
