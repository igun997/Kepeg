<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubBagian;
use App\Models\Bagian;
use App\Models\Gol;
use App\Models\Pegawai;
use App\Models\PegawaiDiklat;
use App\Models\PegawaiPendidikan;
use App\Models\Mutasi;
use App\Models\Admin;
use App\Models\Pensiun;
use App\Models\Kenaikan;
use App\Models\Cuti;
use Nasution\ZenzivaSms\Client as Sms;
use PDF;
class AdminControl extends Controller
{
    public function index(Request $req)
    {
      $data["title"] = "Dashboard Administrator";
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
      return view("kepeg.home")->with($data);
    }
    //Sms
    public function sms()
    {
      $sms = new Sms('e12u4y', 'indra290997');
      $send = [];
      foreach (Pegawai::where(["status_pegawai"=>"aktif"])->get() as $key => $value) {
        $date1=date_create($value->tgl_lahir);
        $date2=date_create(date("Y-m-d"));
        $diff=date_diff($date1,$date2);
        $status = false;
        if ($diff->format("%y") >= 57) {
          $sms->send($value->no_hp, 'Dari Bagian Umum dan Keuangan Sekretariat DPRD Kabupaten Bungo, Kepada Bapak/Ibu '.$value->nama_pegawai.' Untuk Pengajuan Pensiun Batas Umur Sudah Bisa diajukan');
          $send[] = ["jenis_notifikasi"=>"pensiun","nama"=>$value->nama_pegawai,"status"=>"sukses","pesan"=>'Dari Bagian Umum & Keuangan Sekretariat DPRD Kabupaten Bungo, Kepada Bapak/Ibu '.$value->nama_pegawai.' Untuk Pengajuan Pensiun Batas Umur Sudah Bisa diajukan'];
        }
        $date1=date_create($value->mulai_kerja);
        $date2=date_create(date("Y-m-d"));
        $diff=date_diff($date1,$date2);
        $status = false;
        if ($diff->format("%y") >= 4) {
          $sms->send($value->no_hp, 'Dari Bagian Umum dan Keuangan Sekretariat DPRD Kabupaten Bungo, Kepada Bapak/Ibu '.$value->nama_pegawai.' Untuk Pengajuan Kenaikan Golongan Sudah Bisa diajukan');
          $send[] = ["jenis_notifikasi"=>"kenaikan","nama"=>$value->nama_pegawai,"status"=>"sukses","pesan"=>'Dari Bagian Umum & Keuangan Sekretariat DPRD Kabupaten Bungo, Kepada Bapak/Ibu '.$value->nama_pegawai.' Untuk Kenaikan Golongan Sudah Bisa diajukan'];
        }
      }
      return response()->json($send);
    }
    //Admin
    public function data()
    {
      $data["title"] = "Data Administrasi";
      $data["data"] = Admin::all();
      return view("kepeg.admin.index")->with($data);
    }
    public function data_insert(Request $req)
    {
      $req->validate([
        "username"=>"required|unique:admin,username",
        "password"=>"required"
      ]);
      $create = Admin::create($req->all());
      if ($create) {
        return back()->with(["msg"=>"Data Sukses  Di Simpan"]);
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
    }
    public function data_del($id)
    {
      $del = Admin::findOrFail($id)->delete();
      return back()->with(["msg"=>"Data Sukses  Di Hapus"]);
    }
    //Laporan
    public function laporan()
    {
      $data["title"] = "Laporan";
      return view("kepeg.laporan")->with($data);
    }
    public function laporan_aksi(Request $req)
    {
      if ($req->jenis == "pegawai") {
        $data["tanggal_cetak"] = date("d-m-Y");
        $data["data"] = Pegawai::all();
        $pdf = PDF::loadView('pdf.pegawai', $data)->setPaper('a3', 'landscape');
        return $pdf->download('pegawai.pdf');
      }elseif ($req->jenis == "mutasi") {
        $data["tanggal_cetak"] = date("d-m-Y");
        $data["data"] = Mutasi::all();
        $pdf = PDF::loadView('pdf.mutasi', $data)->setPaper('a3', 'landscape');
        return $pdf->download('mutasi.pdf');
      }elseif ($req->jenis == "kenaikan") {
        $data["tanggal_cetak"] = date("d-m-Y");
        $data["data"] = Kenaikan::all();
        $pdf = PDF::loadView('pdf.kenaikan', $data)->setPaper('a3', 'landscape');
        return $pdf->download('kenaikan.pdf');
      }elseif ($req->jenis == "pensiun") {
        $data["tanggal_cetak"] = date("d-m-Y");
        $data["data"] = Pensiun::all();
        $pdf = PDF::loadView('pdf.pensiun', $data)->setPaper('a3', 'landscape');
        return $pdf->download('pensiun.pdf');
      }elseif ($req->jenis == "cuti") {
        $data["tanggal_cetak"] = date("d-m-Y");
        $data["data"] = Cuti::all();
        $pdf = PDF::loadView('pdf.cuti', $data)->setPaper('a3', 'landscape');
        return $pdf->download('cuti.pdf');
      }else {
        return back()->withErrors(["msg"=>"Input tidak valid"]);
      }
    }
    //SubBagian

    public function divisi_index(Request $req)
    {
      $data["title"] = "Data Bagian";
      $data["divisi"] = Bagian::all();
      $data["divisisub"] = SubBagian::all();
      return view("kepeg.divisi.index")->with($data);
    }
    public function divisi_ins(Request $req)
    {
        $data["title"] = "Tambah - Data Bagian";
        return view("kepeg.divisi.form")->with($data);
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
      $x = Bagian::create($req->all());
      if ($x) {
        return back()->with("msg","Data Sukses Di Simpan");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
    }
    public function divisi_insert_sub(Request $req)
    {
      $this->validate($req,[
        "nama_sub"=>"required"
      ]);
      $x = SubBagian::create($req->all());
      if ($x) {
        return back()->with("msg","Data Sukses Di Simpan");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
    }
    public function divisi_detail(Request $req,$id)
    {
      $cek = Bagian::where(["id_bagian"=>$id]);
      if ($cek->count() > 0) {
        $data["title"] = "Sub Bagian [{$cek->first()->nama_divisi}]";
        $data["id"] = $id;
        $data["data"] = $cek->first();
        $data["subbagian"] = $cek->first()->sub_bagians;
        return view("kepeg.divisi.detail")->with($data);
      }else {
        return back()->withErrors(["msg"=>"Error"]);
      }
    }
    public function divisi_delete_sub($id)
    {
      $del = SubBagian::findOrFail($id);
      $status = $del->delete();
      if ($status) {
        return back()->with("msg","Data Sukses Di Hapus");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Hapus"]);
      }
    }
    public function divisi_delete(Request $req,$id)
    {
      $del = Bagian::findOrFail($id);
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
      return view("kepeg.gol.index")->with($data);
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
      $data["pegawai"] = Pegawai::all();
      return view("kepeg.pegawai.index")->with($data);
    }
    public function pegawai_ins(Request $req)
    {
      // route("pegawai.up_action",@$data->nip)
      $data["title"] = "Form Pegawai";
      $data["data"] = [];
      $data["action"] = route("pegawai.add_action");
      return view("kepeg.pegawai.form")->with($data);
    }
    public function pegawai_up(Request $req,$id)
    {
      Pegawai::findOrFail($id);
      $getdata = Pegawai::where(["nip"=>$id]);
      $data["data"] = $getdata->first();
      $data["action"] = route("pegawai.up_action",$id);
      $data["title"] = "Update Data Pegawai";
      return view("kepeg.pegawai.form")->with($data);
    }
    public function pegawai_insert(Request $req)
    {
      $this->validate($req,[
        "nip"=>"required|unique:pegawai",
        "password"=>"required",
        "id_gol"=>"required",
        "id_sub_bagian"=>"required",
        "nama_pegawai"=>"required",
        "tempat_lahir"=>"required",
        "tgl_lahir"=>"required",
        "jk"=>"required",
        "agama"=>"required",
        "jabatan"=>"required",
        "status_perkawinan"=>"required",
        "status_pegawai"=>"required",
        "mulai_kerja"=>"required",
      ]);
      $x = Pegawai::create($req->all());
      if ($x) {
        return back()->with("msg","Data Sukses Di Simpan");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
    }
    public function pegawai_detail($id)
    {
      $cek = Pegawai::where(["nip"=>$id]);
      if ($cek->count() > 0) {
        $data["title"] = "Riwayat Pegawai";
        $data["id"] = $id;
        $data["data"] = $cek->first();
        $data["pegawai_diklats"] = $cek->first()->pegawai_diklats;
        $data["pegawai_pendidikans"] = $cek->first()->pegawai_pendidikans;
        return view("kepeg.pegawai.detail")->with($data);
      }else {
        return back()->withErrors(["msg"=>"Error"]);
      }
    }
    public function pegawai_del_riwayat($id,$riwayat)
    {
      if ($riwayat == "pendidikan") {
        $del = PegawaiPendidikan::find($id)->delete();
        return back()->with(["msg"=>"Sukses Hapus Riwayat"]);
      }elseif($riwayat == "diklat") {
        $del = PegawaiDiklat::find($id)->delete();
        return back()->with(["msg"=>"Sukses Hapus Riwayat"]);
      }else {
        return back()->withErrors(["msg"=>"Gagal Hapus Riwayat"]);
      }
    }
    public function pegawai_insert_riwayat(Request $req, $jenis,$id)
    {
      if ($jenis == "pendidikan") {
        $req->validate([
          "tingkat_pend"=>"required",
          "nama_sekolah"=>"required",
          "bulan_lulus"=>"required",
          "tahun_lulus"=>"required"
        ]);
        $data = $req->all();
        $data["nip"] = $id;
        $create = PegawaiPendidikan::create($data);
      }elseif ($jenis == "diklat") {
        $req->validate([
          "nama_diklat"=>"required",
          "bulan"=>"required",
          "tahun"=>"required"
        ]);
        $data = $req->all();
        $data["nip"] = $id;
        $create = PegawaiDiklat::create($data);
      }else {
        return back()->withErrors(["msg"=>"Failed"]);
      }
      if ($create) {
        return back()->with(["msg"=>"Sukses Input Data Riwayat"]);
      }else {
        return back()->withErrors(["msg"=>"Gagal Input Data Riwayat"]);
      }
    }
    public function pegawai_update(Request $req,$id)
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
      $data["title"] = "Data Cuti";
      $data["cuti"] = Cuti::all();
      $data["cutiAtasan"] = Cuti::where(["status_cuti"=>"disetujui"])->get();
      return view("kepeg.cuti.index")->with($data);
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
        "jns_cuti"=>"required",
      ]);
      $x = Cuti::create($req->all());
      if ($x) {
        return back()->with("msg","Data Sukses Di Simpan");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
    }
    public function cuti_update(Request $req,$id,$status)
    {
      Cuti::where(["id_cuti"=>$id])->update(["status"=>$status]);
      return back();
    }
    public function cuti_update_admin(Request $req,$id,$status)
    {
      Cuti::where(["id_cuti"=>$id])->update(["status_cuti"=>$status]);
      if ($status == "ditolak") {
        Cuti::where(["id_cuti"=>$id])->update(["status"=>$status]);
      }
      return back();
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
      $data["pensiun"] = Pensiun::all();
      $data["pensiunAtasan"] = Pensiun::where(["status_pensiun"=>"disetujui"])->get();
      return view("kepeg.pensiun.index")->with($data);
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
        "keterangan"=>"required",
      ]);
      $x = Pensiun::create($req->all());
      if ($x) {
        return back()->with("msg","Data Sukses Di Simpan");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
    }
    public function pensiun_update(Request $req,$id,$status)
    {
      Pensiun::where(["id_pensiun"=>$id])->update(["status"=>$status]);
      return back();
    }
    public function pensiun_update_admin(Request $req,$id,$status)
    {
      // echo $status;
      Pensiun::where(["id_pensiun"=>$id])->update(["status_pensiun"=>$status]);
      if ($status == "ditolak") {
        Pensiun::where(["id_pensiun"=>$id])->update(["status"=>$status]);
      }
      return back();
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
      $data["mutasi"] = Mutasi::all();
      $data["mutasiAtasan"] = Mutasi::where(["status_mutasi"=>"disetujui"])->get();
      return view("kepeg.mutasi.index")->with($data);
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
      ]);
      $x = Mutasi::create($req->all());
      if ($x) {
        return back()->with("msg","Data Sukses Di Simpan");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
    }
    public function mutasi_update(Request $req,$id,$status)
    {
      Mutasi::where(["id_mutasi"=>$id])->update(["status_validasi"=>$status]);
      return back();
    }
    public function mutasi_update_admin(Request $req,$id,$status)
    {
      Mutasi::where(["id_mutasi"=>$id])->update(["status_mutasi"=>$status]);
      if ($status == "ditolak") {
        Mutasi::where(["id_mutasi"=>$id])->update(["status_validasi"=>$status]);
      }
      return back();
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
      $data["kenaikan"] = Kenaikan::all();
      $data["kenaikanAtasan"] = Kenaikan::where(["status_kenaikan"=>"disetujui"])->get();
      return view("kepeg.kenaikan.index")->with($data);
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
      ]);
      $x = Kenaikan::create($req->all());
      if ($x) {
        return back()->with("msg","Data Sukses Di Simpan");
      }else {
        return back()->withErrors(["msg"=>"Data Gagal Di Simpan"]);
      }
    }
    public function kenaikan_update(Request $req,$id,$status)
    {
      Kenaikan::where(["id_kenaikan"=>$id])->update(["status"=>$status]);
      return back();
    }
    public function kenaikan_update_admin(Request $req,$id,$status)
    {
      Kenaikan::where(["id_kenaikan"=>$id])->update(["status_kenaikan"=>$status]);
      if ($status == "ditolak") {
        Kenaikan::where(["id_kenaikan"=>$id])->update(["status"=>$status]);
      }
      return back();
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
