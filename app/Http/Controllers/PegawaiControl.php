<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bagian;
use App\Models\Gol;
use App\Models\Pegawai;
use App\Models\Mutasi;
use App\Models\Pensiun;
use App\Models\Kenaikan;
use App\Models\Cuti;
class PegawaiControl extends Controller
{

  public function index(Request $req)
  {
    $data["title"] = "Dashboard Pegawai";
    $label = [];
    $da = [];
    foreach (Bagian::all() as $key => $value) {
      foreach ($value->sub_bagians as $k => $v) {
        $label[] = $value->nama_divisi." - ".$v->nama_sub;
        $da[] = $v->pegawais->count();
      }
    }
    $chartjs = app()->chartjs
    ->name('barChartTest')
    ->type('bar')
    ->size(['width' => 400, 'height' => 200])
    ->labels($label)
    ->datasets([
      [
        "label" => "Grafik Bagian & Sub Bagian",
        'backgroundColor' => '#17A2B8',
        'data' => $da
      ]
    ])
    ->options([]);
    $data["chart"] = $chartjs;
    return view("pegawai.home")->with($data);
  }
  //Divisi

  public function divisi_index(Request $req)
  {
    $data["title"] = "Data Divisi";
    $data["divisi"] = Divisi::all();
    return view("pegawai.divisi.index")->with($data);
  }
  public function divisi_ins(Request $req)
  {
    // code...
  }
  public function divisi_up(Request $req)
  {
    // code...
  }
  public function divisi_insert(Request $req)
  {
    $this->validate($req,[
      "nama_divisi"=>"required"
    ]);
    $x = Divisi::create($req->all());
    if ($x) {
      return back()->with("msg","Data Sukses Di Simpan");
    }else {
      return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
    }
  }
  public function divisi_update(Request $req)
  {
    // code...
  }
  public function divisi_delete(Request $req,$id)
  {
    $del = Divisi::findOrFail($id);
    $status = $del->delete();
    if ($status) {
      return back()->with("msg","Data Sukses Di Hapus");
    }else {
      return back()->withErrors(["msg"=>"Data Gagal Di Hapus"]);
    }

  }

  // Gol

  public function gol_index(Request $req)
  {
    $data["title"] = "Data Golongan";
    $data["gol"] = Gol::all();
    return view("pegawai.gol.index")->with($data);
  }
  public function gol_ins(Request $req)
  {
    // code...
  }
  public function gol_up(Request $req)
  {
    // code...
  }
  public function gol_insert(Request $req)
  {
    $this->validate($req,[
      "nama_gol"=>"required"
    ]);
    $x = Gol::create($req->all());
    if ($x) {
      return back()->with("msg","Data Sukses Di Simpan");
    }else {
      return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
    }
  }
  public function gol_update(Request $req)
  {
    // code...
  }
  public function gol_delete(Request $req,$id)
  {
    $del = Gol::findOrFail($id);
    $status = $del->delete();
    if ($status) {
      return back()->with("msg","Data Sukses Di Hapus");
    }else {
      return back()->withErrors(["msg"=>"Data Gagal Di Hapus"]);
    }

  }

  //Pegawai
  public function pegawai_index(Request $req)
  {
    $data["title"] = "Data Pegawai";
    $data["pegawai"] = Pegawai::where(["nip"=>session()->get("nip")])->get();
    return view("pegawai.pegawai.index")->with($data);
  }
  public function pegawai_ins(Request $req)
  {
    // code...
  }
  public function pegawai_up(Request $req)
  {
    // code...
  }
  public function pegawai_insert(Request $req)
  {
    $this->validate($req,[
      "nip"=>"required|unique:pegawai",
      "password"=>"required",
      "id_gol"=>"required",
      "id_divisi"=>"required",
      "nama_pegawai"=>"required",
      "tempat_lahir"=>"required",
      "tgl_lahir"=>"required",
      "jk"=>"required",
      "agama"=>"required",
      "alamat"=>"required",
      "gol_darah"=>"required",
      "npwp"=>"required",
      "jabatan"=>"required",
      "sk"=>"required",
      "status_perkawinan"=>"required",
      "jml_anak"=>"required_with:status_pegawai,menikah",
      "status_pegawai"=>"required",
      "pend_terakhir"=>"required",
      "telp"=>"required",
      "hp"=>"required",
      "jenis"=>"required",
      "mulai_kerja"=>"required",
    ]);
    $x = Pegawai::create($req->all());
    if ($x) {
      return back()->with("msg","Data Sukses Di Simpan");
    }else {
      return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
    }
  }
  public function pegawai_update(Request $req)
  {
    // code...
  }
  public function pegawai_delete(Request $req,$id)
  {
    $del = Pegawai::findOrFail($id);
    $status = $del->delete();
    if ($status) {
      return back()->with("msg","Data Sukses Di Hapus");
    }else {
      return back()->withErrors(["msg"=>"Data Gagal Di Hapus"]);
    }
  }

  //Cuti
  public function cuti_index(Request $req)
  {
    $dataCuti = Cuti::where(["nip"=>session()->get("nip")]);
    $data["title"] = "Data Cuti";
    $data["cuti"] = $dataCuti->get();
    if ($dataCuti->count() > 0) {
      $saldoPer = 12;
      $date1=date_create($dataCuti->first()->mulai_kerja);
      $date2=date_create(date("Y-m-d"));
      $diff=date_diff($date1,$date2);
      if ($diff->format("%y") == 0) {
        $saldoPer = 12;
      }else {
        $saldoPer = $diff->format("%y")*12;
      }
      $saldocuti = 0;
      $dataSaldo = Cuti::where(["nip"=>session()->get("nip"),"status"=>"disetujui","jns_cuti"=>null])->whereYear('tgl_cuti', '=', date("Y"));
      foreach ($dataSaldo->get() as $key => $value) {
        $date1=date_create($value->tgl_cuti);
        $date2=date_create($value->tgl_selesai);
        $diff=date_diff($date1,$date2);
        $saldocuti = $saldocuti + $diff->format("%d");
      }
      $dataSaldominus = Cuti::where(["nip"=>session()->get("nip"),"status"=>"disetujui","jns_cuti"=>null])->whereDate('tgl_cuti', '=>', $dataCuti->first()->mulai_kerja)->whereDate("tgl_cuti","=<",(date("Y")-1)."01-01");
      $saldo = 0;
      foreach ($dataSaldominus as $key => $value) {
        $date1=date_create($value->tgl_cuti);
        $date2=date_create($value->tgl_selesai);
        $diff=date_diff($date1,$date2);
        $saldo = $saldo + $diff->format("%d");
      }
      $date1=date_create($dataCuti->first()->mulai_kerja);
      $date2=date_create((date("Y")-1)."01-01");
      $diff=date_diff($date1,$date2);
      if ($diff->format("%y") == 0) {
        $saldo = 0;
      }else {
        $saldo = $saldo / $diff->format("%y");
      }
      $saldocuti = ($saldoPer - $saldocuti) - $saldo;
    }else {
      $saldocuti = 12;
    }
    $data["saldo"] = $saldocuti;
    return view("pegawai.cuti.index")->with($data);
  }
  public function cuti_ins(Request $req)
  {
    // code...
  }
  public function cuti_up(Request $req)
  {
    // code...
  }
  public function cuti_insert(Request $req)
  {
    $this->validate($req,[
      "nip"=>"required",
      "tgl_cuti"=>"required",
      "tgl_selesai"=>"required",
    ]);
    $data = $req->all();
    $saldo = $data["saldo_cuti"];
    unset($data["saldo_cuti"]);
    if ($data["jns_cuti"] == "") {
      $date1=date_create($data["tgl_cuti"]);
      $date2=date_create($data["tgl_selesai"]);
      $diff=date_diff($date1,$date2);
      if ($diff->format("%d") > $saldo) {
        return back()->withErrors(["msg"=>"Saldo Cuti Anda Tidak Cukup"]);
      }
    }
    $cek = Cuti::where(["nip"=>session()->get("nip"),"status"=>"menunggu"])->count();
    $ceko = Cuti::where(["nip"=>session()->get("nip"),"status_cuti"=>"menunggu"])->count();
    if ($ceko > 0) {
      return back()->withErrors(["msg"=>"Menunggu Validasi Admin"]);
    }else {
      if ($cek > 0) {
        return back()->withErrors(["msg"=>"Menunggu Validasi Atasan"]);
      }
    }
    if ($req->has("berkas")) {
      $image = $req->file('berkas');
      $name = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/upload');
      $save = $image->move($destinationPath, $name);
      if (!$save) {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
      $data["berkas"] = $name;
    }
    $x = Cuti::create($data);
    if ($x) {
      return back()->with("msg","Data Sukses Di Simpan");
    }else {
      return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
    }
  }
  public function akun()
  {
    Pegawai::findOrFail(session()->get("nip"));
    $getdata = Pegawai::where(["nip"=>session()->get("nip")]);
    $data["data"] = $getdata->first();
    $data["title"] = "Profil Pegawai";
    return view("pegawai.akun.index")->with($data);
  }
  public function akun_update(Request $req,$id)
  {
    $find = Pegawai::findOrFail($id);
    $data = $req->all();
    unset($data["_token"]);
    if ($data["password"] == "") {
      unset($data["password"]);
    }
    $fix = $find->update($data);
    if ($fix) {
      return back()->with(["msg"=>"Sukses Input Data"]);
    }else {
      return back()->withErrors(["msg"=>"Gagal Input Data"]);
    }
  }
  public function cuti_update(Request $req)
  {
    // code...
  }
  public function cuti_delete(Request $req,$id)
  {
    $del = Cuti::findOrFail($id);
    $status = $del->delete();
    if ($status) {
      return back()->with("msg","Data Sukses Di Hapus");
    }else {
      return back()->withErrors(["msg"=>"Data Gagal Di Hapus"]);
    }

  }
  //Pensiun
  public function pensiun_index(Request $req)
  {
    $data["title"] = "Data Pensiun";
    $data["data"] =  Pegawai::where(["nip"=>session()->get("nip")]);
    $tgl_lahir = Pegawai::where(["nip"=>session()->get("nip")])->first()->tgl_lahir;
    $date1=date_create($tgl_lahir);
    $date2=date_create(date("Y-m-d"));
    $diff=date_diff($date1,$date2);
    $status = false;
    if ($diff->format("%y") >= 57) {
      $status = true;
    }
    $data["status_umur"] = $status;
    $data["pensiun"] = Pensiun::where(["nip"=>session()->get("nip")])->get();
    return view("pegawai.pensiun.index")->with($data);
  }
  public function pensiun_ins(Request $req)
  {
    // code...
  }
  public function pensiun_up(Request $req)
  {
    // code...
  }
  public function pensiun_insert(Request $req)
  {
    $this->validate($req,[
      "nip"=>"required",
      "tanggal"=>"required",
      "berkas"=>"mimes:pdf",
    ]);
    $cek = Pensiun::where(["nip"=>session()->get("nip"),"status"=>"menunggu"])->count();
    $ceko = Pensiun::where(["nip"=>session()->get("nip"),"status_pensiun"=>"menunggu"])->count();
    if ($ceko > 0) {
      return back()->withErrors(["msg"=>"Menunggu Validasi Admin"]);
    }else {
      if ($cek > 0) {
        return back()->withErrors(["msg"=>"Menunggu Validasi Atasan"]);
      }
    }
    $d = $req->all();
    unset($d["_token"]);
    if ($req->has("berkas")) {
      $image = $req->file('berkas');
      $name = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/upload');
      $save = $image->move($destinationPath, $name);
      if (!$save) {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
      $d["berkas"] = $name;
    }
    // return response()->json($d);
    $x = Pensiun::create($d);
    if ($x) {
      return back()->with("msg","Data Sukses Di Simpan");
    }else {
      return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
    }
  }
  public function pensiun_update(Request $req)
  {
    // code...
  }
  public function pensiun_delete(Request $req,$id)
  {
    $del = Pensiun::findOrFail($id);
    $status = $del->delete();
    if ($status) {
      return back()->with("msg","Data Sukses Di Hapus");
    }else {
      return back()->withErrors(["msg"=>"Data Gagal Di Hapus"]);
    }

  }
  //Mutasi
  public function mutasi_index(Request $req)
  {
    $data["title"] = "Data Mutasi";
    $data["mutasi"] = Mutasi::where(["nip"=>session()->get("nip")])->get();
    return view("pegawai.mutasi.index")->with($data);
  }
  public function mutasi_ins(Request $req)
  {
    // code...
  }
  public function mutasi_up(Request $req)
  {
    // code...
  }
  public function mutasi_insert(Request $req)
  {
    $this->validate($req,[
      "nip"=>"required",
      "tgl_mutasi"=>"required",
      "asal"=>"required",
      "tujuan"=>"required",
      "berkas"=>"mimes:pdf",
    ]);
    $d = $req->all();
    if ($req->has("berkas")) {
      $image = $req->file('berkas');
      $name = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/upload');
      $save = $image->move($destinationPath, $name);
      if (!$save) {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
      $d["berkas"] = $name;
    }
    $cek = Mutasi::where(["nip"=>session()->get("nip"),"status_validasi"=>"menunggu"])->count();
    $ceko = Mutasi::where(["nip"=>session()->get("nip"),"status_mutasi"=>"menunggu"])->count();
    if ($ceko > 0) {
      return back()->withErrors(["msg"=>"Menunggu Validasi Admin"]);
    }else {
      if ($cek > 0) {
        return back()->withErrors(["msg"=>"Menunggu Validasi Atasan"]);
      }
    }
    // return response()->json($d);
    $x = Mutasi::create($d);
    if ($x) {
      return back()->with("msg","Data Sukses Di Simpan");
    }else {
      return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
    }
  }
  public function mutasi_update(Request $req)
  {
    // code...
  }
  public function mutasi_delete(Request $req,$id)
  {
    $del = Mutasi::findOrFail($id);
    $status = $del->delete();
    if ($status) {
      return back()->with("msg","Data Sukses Di Hapus");
    }else {
      return back()->withErrors(["msg"=>"Data Gagal Di Hapus"]);
    }

  }
  //Kenaikan
  public function kenaikan_index(Request $req)
  {
    $data["title"] = "Data Kenaikan";
    $tgl_lahir = Pegawai::where(["nip"=>session()->get("nip")])->first()->mulai_kerja;
    $date1=date_create($tgl_lahir);
    $date2=date_create(date("Y-m-d"));
    $diff=date_diff($date1,$date2);
    $status = false;
    if ($diff->format("%y") >= 4) {
      $status = true;
    }
    $data["status_umur"] = $status;
    $data["kenaikan"] = Kenaikan::where(["nip"=>session()->get("nip")])->get();
    return view("pegawai.kenaikan.index")->with($data);
  }
  public function kenaikan_ins(Request $req)
  {
    // code...
  }
  public function kenaikan_up(Request $req)
  {
    // code...
  }
  public function kenaikan_insert(Request $req)
  {
    $this->validate($req,[
      "nip"=>"required",
      "tanggal"=>"required",
      "jenis"=>"required",
      "asal"=>"required",
      "tujuan"=>"required",
      "berkas"=>"mimes:pdf"
    ]);
    $d = $req->all();
    if ($req->has("berkas")) {
      $image = $req->file('berkas');
      $name = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/upload');
      $save = $image->move($destinationPath, $name);
      if (!$save) {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
      $d["berkas"] = $name;
    }
    $cek = Kenaikan::where(["nip"=>session()->get("nip"),"status"=>"menunggu"])->count();
    $ceko = Kenaikan::where(["nip"=>session()->get("nip"),"status_kenaikan"=>"menunggu"])->count();
    if ($ceko > 0) {
      return back()->withErrors(["msg"=>"Menunggu Validasi Admin"]);
    }else {
      if ($cek > 0) {
        return back()->withErrors(["msg"=>"Menunggu Validasi Atasan"]);
      }
    }
    $x = Kenaikan::create($d);
    if ($x) {
      return back()->with("msg","Data Sukses Di Simpan");
    }else {
      return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
    }
  }
  public function kenaikan_update(Request $req)
  {
    // code...
  }

  public function kenaikan_delete(Request $req,$id)
  {
    $del = Kenaikan::findOrFail($id);
    $status = $del->delete();
    if ($status) {
      return back()->with("msg","Data Sukses Di Hapus");
    }else {
      return back()->withErrors(["msg"=>"Data Gagal Di Hapus"]);
    }
  }

}
