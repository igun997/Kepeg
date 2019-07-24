@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Form Pegawai</h5>
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
        <form action="{{$action}}" method="post">
          @csrf
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>NIP</label>
                <input type="text" class="form-control" name="nip" value="{{@$data->nip}}" placeholder="" {{(isset($data->nip))?"disabled":""}}>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Ubah Untuk Ganti Password">
              </div>
              <div class="form-group">
                <label>Golongan</label>
                <select class="form-control" name="id_gol">
                  @foreach(\App\Models\Gol::all() as $key => $value)
                  @if(@$data->id_gol == $value->id_gol)
                  <option value="{{$value->id_gol}}">{{$value->nama_gol}}</option>
                  @endif
                  <option value="{{$value->id_gol}}">{{$value->nama_gol}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Bagian</label>
                <select class="form-control" name="id_sub_bagian">
                  @foreach(\App\Models\SubBagian::all() as $key => $value)
                  @if(@$data->id_divisi == $value->id_divisi)
                  <option value="{{$value->id_sub_bagian}}">{{$value->bagian->nama_divisi}} - {{$value->nama_sub}}</option>
                  @endif
                  <option value="{{$value->id_sub_bagian}}">{{$value->bagian->nama_divisi}} - {{$value->nama_sub}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Nama Pegawai</label>
                <input type="text" class="form-control" value="{{@$data->nama_pegawai}}" name="nama_pegawai" placeholder="">
              </div>
              <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir" value="{{@$data->tempat_lahir}}" placeholder="">
              </div>
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" max="{{date("Y-m-d",strtotime("-20 years"))}}" class="form-control" name="tgl_lahir" value="{{(isset($data->tgl_lahir))?date("Y-m-d",strtotime($data->tgl_lahir)):date("Y-m-d",strtotime("-20 years"))}}" placeholder="">
              </div>
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="form-control" name="jk">
                  @if(@$data->jk == "laki-laki")
                  <option value="laki-laki" selected>Laki - Laki</option>
                  <option value="perempuan">Perempuan</option>
                  @else
                  <option value="laki-laki">Laki - Laki</option>
                  <option value="perempuan" selected>Perempuan</option>
                  @endif
                </select>
              </div>
              <div class="form-group">
                <label>Agama</label>
                <select class="form-control" name="agama">
                  <option value="{{@$data->agama}}" selected>{{ucfirst(@$data->agama)}}</option>
                  <option value="islam">{{ucfirst("islam")}}</option>
                  <option value="kristen">{{ucfirst("kristen")}}</option>
                  <option value="budha">{{ucfirst("budha")}}</option>
                  <option value="katolik">{{ucfirst("katolik")}}</option>
                  <option value="hindu">{{ucfirst("hindu")}}</option>
                </select>
              </div>
            </div>
            <div class="col-6">

              <div class="form-group">
                <label>Jabatan</label>
                <input type="text" class="form-control" name="jabatan" value="{{@$data->jabatan}}" placeholder="">
              </div>
              <div class="form-group">
                <label>Nomor HP</label>
                <input type="text" class="form-control" name="no_hp" value="{{@$data->no_hp}}" placeholder="">
              </div>
              <div class="form-group">
                <label>Status Hubungan</label>
                <select class="form-control" name="status_perkawinan">
                  <option value="{{@$data->status_perkawinan}}">{{ucfirst(@$data->status_perkawinan)}}</option>
                  <option value="menikah">Menikah</option>
                  <option value="belum menikah">Belum Menikah</option>
                </select>
              </div>
              <div class="form-group">
                <label>Status Pegawai</label>
                <select class="form-control" name="status_pegawai">
                  <option value="{{@$data->status_pegawai}}" selected>{{ucfirst(@$data->status_pegawai)}}</option>
                  <option value="aktif">Aktif</option>
                  <option value="mutasi">Mutasi</option>
                  <option value="cuti">Cuti</option>
                  <option value="pensiun">Pensiun</option>
                </select>
              </div>
              <div class="form-group">
                <label>Mulai Kerja</label>
                <input type="date" class="form-control" max="{{date("Y-m-d")}}" value="{{(isset($data->mulai_kerja))?date("Y-m-d",strtotime($data->mulai_kerja)):date("Y-m-d")}}" {{(isset($data->nip))?"readonly":""}} name="mulai_kerja" placeholder="">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">
                  Simpan
                </button>
              </div>
            </div>
          </div>


        </form>
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
