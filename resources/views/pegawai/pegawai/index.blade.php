@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Tambah Pegawai</h5>
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
        <form action="{{route("pegawai_pegawai.add_action")}}" method="post">
          @csrf
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>NIP</label>
                <input type="text" class="form-control" name="nip" placeholder="">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="">
              </div>
              <div class="form-group">
                <label>Golongan</label>
                <select class="form-control" name="id_gol">
                  @foreach(\App\Models\Gol::all() as $key => $value)
                  <option value="{{$value->id_gol}}">{{$value->nama_gol}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Divisi</label>
                <select class="form-control" name="id_divisi">
                  @foreach(\App\Models\Divisi::all() as $key => $value)
                  <option value="{{$value->id_divisi}}">{{$value->nama_divisi}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Nama Pegawai</label>
                <input type="text" class="form-control" name="nama_pegawai" placeholder="">
              </div>
              <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" class="form-control" name="tempat_lahir" placeholder="">
              </div>
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" class="form-control" name="tgl_lahir" placeholder="">
              </div>
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="form-control" name="jk">
                  <option value="laki-laki">Laki - Laki</option>
                  <option value="perempuan">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label>Agama</label>
                <select class="form-control" name="agama">
                  <option value="islam">{{ucfirst("islam")}}</option>
                  <option value="kristen">{{ucfirst("kristen")}}</option>
                  <option value="budha">{{ucfirst("budha")}}</option>
                  <option value="katolik">{{ucfirst("katolik")}}</option>
                  <option value="hindu">{{ucfirst("hindu")}}</option>
                </select>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" rows="3" cols="80" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <label>Golongan Darah</label>
                <input type="text" class="form-control" name="gol_darah" placeholder="">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>NPWP</label>
                <input type="text" class="form-control" name="npwp" placeholder="">
              </div>
              <div class="form-group">
                <label>Jabatan</label>
                <input type="text" class="form-control" name="jabatan" placeholder="">
              </div>
              <div class="form-group">
                <label>SK</label>
                <input type="text" class="form-control" name="sk" placeholder="">
              </div>
              <div class="form-group">
                <label>Status Hubungan</label>
                <select class="form-control" name="status_perkawinan">
                  <option value="menikah">Menikah</option>
                  <option value="belum menikah">Belum Menikah</option>
                </select>
              </div>
              <div class="form-group">
                <label>Jumlah Anak</label>
                <input type="number" class="form-control" name="jml_anak" placeholder="">
              </div>
              <div class="form-group">
                <label>Status Pegawai</label>
                <select class="form-control" name="status_pegawai">
                  <option value="aktif">Aktif</option>
                  <option value="mutasi">Mutasi</option>
                  <option value="pensiun">Pensiun</option>
                </select>
              </div>
              <div class="form-group">
                <label>Pendidikan Terakhir</label>
                <select class="form-control" name="pend_terakhir">
                  <option value="SD">SD</option>
                  <option value="SMP">SMP</option>
                  <option value="SMA">SMA</option>
                  <option value="S1">S1</option>
                  <option value="S2">S2</option>
                  <option value="S3">S3</option>
                  <option value="PROF">PROF</option>
                  <option value="DR">DR</option>
                </select>
              </div>
              <div class="form-group">
                <label>Telepon</label>
                <input type="number" class="form-control" name="telp" placeholder="">
              </div>
              <div class="form-group">
                <label>HP</label>
                <input type="number" class="form-control" name="hp" placeholder="">
              </div>
              <div class="form-group">
                <label>Jenis</label>
                <select class="form-control" name="jenis">
                  <option value="struktural">Struktural</option>
                  <option value="fungsional">Fungsional</option>
                </select>
              </div>
              <div class="form-group">
                <label>Mulai Kerja</label>
                <input type="date" class="form-control" name="mulai_kerja" placeholder="">
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
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Data Pegawai</h5>
    </div>
    <div class="card-body">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table dt">
            <thead>
              <th>NIP</th>
              <th>Nama</th>
              <th>Gol</th>
              <th>Divisi</th>
              <th>TTL</th>
              <th>JenKel</th>
              <th>Agama</th>
              <th>Alamat</th>
              <th>GolDar</th>
              <th>NPWP</th>
              <th>Jabatan</th>
              <th>SK</th>
              <th>Status Kawin</th>
              <th>Jml. Anak</th>
              <th>Status Peg.</th>
              <th>Pend. Akhir</th>
              <th>Telp</th>
              <th>Hp</th>
              <th>Mulai Kerja</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              @foreach($pegawai as $k => $v)
              <tr>
                <td>{{$v->nip}}</td>
                <td>{{$v->nama_pegawai}}</td>
                <td>{{$v->gol->nama_gol}}</td>
                <td>{{$v->divisi->nama_divisi}}</td>
                <td>{{$v->tempat_lahir}},{{date("d-m-Y",strtotime($v->tgl_lahir))}}</td>
                <td>{{$v->jk}}</td>
                <td>{{$v->agama}}</td>
                <td>{{$v->alamat}}</td>
                <td>{{$v->gol_darah}}</td>
                <td>{{$v->npwp}}</td>
                <td>{{$v->jabatan}}</td>
                <td>{{$v->sk}}</td>
                <td>{{$v->status_perkawinan}}</td>
                <td>{{$v->jml_anak}}</td>
                <td>{{$v->status_pegawai}}</td>
                <td>{{$v->pend_terakhir}}</td>
                <td>{{$v->telp}}</td>
                <td>{{$v->hp}}</td>
                <td>{{date("d-m-Y",strtotime($v->mulai_kerja))}}</td>
                <td>
                  <a href="{{route("pegawai.del",$v->nip)}}" class="btn btn-danger">
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
@endsection
@section("js")
<script type="text/javascript">
  $(document).ready(function() {
    table = $(".dt").dataTable({});
  });
</script>
@endsection
