<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function()
{
  return redirect("login");
});
Route::get('/login', function()
{
  return redirect("login");
});
Route::get('/cron',"AdminControl@sms");
Route::get('/login',"LoginControl@pegawai");
Route::post('/login/pegawai',"LoginControl@login_pegawai")->name("login_pegawai");
Route::get("/logout",function(){
  return redirect("login");
});
Route::group(['middleware' => ['admin']], function () {
    Route::get('admin',"AdminControl@index")->name("admin");
    Route::get('admin/data',"AdminControl@data")->name("admin.data");
    Route::post('admin/data',"AdminControl@data_insert")->name("admin.add_action");
    Route::get('admin/data/{id}',"AdminControl@data_del")->name("admin.del");
    //Divisi
    Route::get('admin/divisi',"AdminControl@divisi_index")->name("divisi");
    Route::get('admin/divisi/add',"AdminControl@divisi_ins")->name("divisi.add");
    Route::get('admin/subdivisi/add',"AdminControl@divisi_ins_sub")->name("divisisub.add");
    Route::post('admin/divisi/add',"AdminControl@divisi_insert")->name("divisi.add_action");
    Route::post('admin/subdivisi/add',"AdminControl@divisi_insert_sub")->name("divisisub.add_action");
    Route::get('admin/divisi/detail/{id}',"AdminControl@divisi_detail")->name("divisi.detail");

    Route::get('admin/divisi/up/{id}',"AdminControl@divisi_up")->name("divisi.up");
    Route::post('admin/divisi/up/{id}',"AdminControl@divisi_update")->name("divisi.up_action");
    Route::get('admin/divisi/del/{id}',"AdminControl@divisi_delete")->name("divisi.del");
    Route::get('admin/subdivisi/del/{id}',"AdminControl@divisi_delete_sub")->name("divisisub.del");
    // Golongan
    Route::get('admin/gol',"AdminControl@gol_index")->name("gol");
    Route::get('admin/gol/add',"AdminControl@gol_ins")->name("gol.add");
    Route::post('admin/gol/add',"AdminControl@gol_insert")->name("gol.add_action");
    Route::get('admin/gol/up/{id}',"AdminControl@gol_up")->name("gol.up");
    Route::post('admin/gol/up/{id}',"AdminControl@gol_update")->name("gol.up_action");
    Route::get('admin/gol/del/{id}',"AdminControl@gol_delete")->name("gol.del");
    // Pegawai
    Route::get('admin/pegawai',"AdminControl@pegawai_index")->name("pegawai");
    Route::get('admin/pegawai/add',"AdminControl@pegawai_ins")->name("pegawai.add");
    Route::post('admin/pegawai/add',"AdminControl@pegawai_insert")->name("pegawai.add_action");
    Route::post('admin/pegawai/add/riwayat/{jenis}/{id}',"AdminControl@pegawai_insert_riwayat")->name("pegawai.add_action_riwayat");
    Route::get('admin/pegawai/del/{id}/{riwayat}',"AdminControl@pegawai_del_riwayat")->name("pegawai.del_riwayat");
    Route::get('admin/pegawai/up/{id}',"AdminControl@pegawai_up")->name("pegawai.up");
    Route::post('admin/pegawai/up/{id}',"AdminControl@pegawai_update")->name("pegawai.up_action");
    Route::get('admin/pegawai/del/{id}',"AdminControl@pegawai_delete")->name("pegawai.del");
    Route::get('admin/pegawai/detail/{id}',"AdminControl@pegawai_detail")->name("pegawai.detail");
    //Cuti
    Route::get('admin/cuti',"AdminControl@cuti_index")->name("cuti");
    Route::get('admin/cuti/add',"AdminControl@cuti_ins")->name("cuti.add");
    Route::post('admin/cuti/add',"AdminControl@cuti_insert")->name("cuti.add_action");
    Route::get('admin/cuti/up/{id}',"AdminControl@cuti_up")->name("cuti.up");
    Route::get('admin/cuti/up/{id}/{status}',"AdminControl@cuti_update")->name("cuti.up_action");
    Route::get('admin/cuti/up_admin/{id}/{status}',"AdminControl@cuti_update_admin")->name("cuti.up_action_admin");
    Route::get('admin/cuti/del/{id}',"AdminControl@cuti_delete")->name("cuti.del");
    //Pensiun
    Route::get('admin/pensiun',"AdminControl@pensiun_index")->name("pensiun");
    Route::get('admin/pensiun/add',"AdminControl@pensiun_ins")->name("pensiun.add");
    Route::post('admin/pensiun/add',"AdminControl@pensiun_insert")->name("pensiun.add_action");
    Route::get('admin/pensiun/up/{id}',"AdminControl@pensiun_up")->name("pensiun.up");
    Route::get('admin/pensiun/up/{id}/{status}',"AdminControl@pensiun_update")->name("pensiun.up_action");
    Route::get('admin/pensiun/up_admin/{id}/{status}',"AdminControl@pensiun_update_admin")->name("pensiun.up_action_admin");
    Route::get('admin/pensiun/del/{id}',"AdminControl@pensiun_delete")->name("pensiun.del");
    //Mutasi
    Route::get('admin/mutasi',"AdminControl@mutasi_index")->name("mutasi");
    Route::get('admin/mutasi/add',"AdminControl@mutasi_ins")->name("mutasi.add");
    Route::post('admin/mutasi/add',"AdminControl@mutasi_insert")->name("mutasi.add_action");
    Route::get('admin/mutasi/up/{id}',"AdminControl@mutasi_up")->name("mutasi.up");
    Route::get('admin/mutasi/up/{id}/{status}',"AdminControl@mutasi_update")->name("mutasi.up_action");
    Route::get('admin/mutasi/up_admin/{id}/{status}',"AdminControl@mutasi_update_admin")->name("mutasi.up_action_admin");
    Route::get('admin/mutasi/del/{id}',"AdminControl@mutasi_delete")->name("mutasi.del");
    //Kenaikan
    Route::get('admin/kenaikan',"AdminControl@kenaikan_index")->name("kenaikan");
    Route::get('admin/kenaikan/add',"AdminControl@kenaikan_ins")->name("kenaikan.add");
    Route::post('admin/kenaikan/add',"AdminControl@kenaikan_insert")->name("kenaikan.add_action");
    Route::get('admin/kenaikan/up/{id}',"AdminControl@kenaikan_up")->name("kenaikan.up");
    Route::get('admin/kenaikan/up/{id}/{status}',"AdminControl@kenaikan_update")->name("kenaikan.up_action");
    Route::get('admin/kenaikan/up_admin/{id}/{status}',"AdminControl@kenaikan_update_admin")->name("kenaikan.up_action_admin");
    Route::get('admin/kenaikan/del/{id}',"AdminControl@kenaikan_delete")->name("kenaikan.del");
    //Laporan
    Route::get('admin/laporan',"AdminControl@laporan")->name("laporan");
    Route::post('admin/laporan',"AdminControl@laporan_aksi")->name("laporan.aksi");
});

Route::group(['middleware' => ['pegawai']], function () {
  Route::get('pegawai',"PegawaiControl@index")->name("pengawai.home");
  Route::get('pegawai/akun',"PegawaiControl@akun")->name("pengawai.akun");
  Route::post('pegawai/akun/{id}',"PegawaiControl@akun_update")->name("pengawai.akun.submit");
    //Divisi
    Route::get('pegawai/divisi',"PegawaiControl@divisi_index")->name("divisi_pegawai");
    Route::get('pegawai/divisi/add',"PegawaiControl@divisi_ins")->name("divisi_pegawai.add");
    Route::post('pegawai/divisi/add',"PegawaiControl@divisi_insert")->name("divisi_pegawai.add_action");
    Route::get('pegawai/divisi/up/{id}',"PegawaiControl@divisi_up")->name("divisi_pegawai.up");
    Route::post('pegawai/divisi/up/{id}',"PegawaiControl@divisi_update")->name("divisi_pegawai.up_action");
    Route::get('pegawai/divisi/del/{id}',"PegawaiControl@divisi_delete")->name("divisi_pegawai.del");
    // Golongan
    Route::get('pegawai/gol',"PegawaiControl@gol_index")->name("gol_pegawai");
    Route::get('pegawai/gol/add',"PegawaiControl@gol_ins")->name("gol_pegawai.add");
    Route::post('pegawai/gol/add',"PegawaiControl@gol_insert")->name("gol_pegawai.add_action");
    Route::get('pegawai/gol/up/{id}',"PegawaiControl@gol_up")->name("gol_pegawai.up");
    Route::post('pegawai/gol/up/{id}',"PegawaiControl@gol_update")->name("gol_pegawai.up_action");
    Route::get('pegawai/gol/del/{id}',"PegawaiControl@gol_delete")->name("gol_pegawai.del");
    // Pegawai
    Route::get('pegawai/pegawai',"PegawaiControl@pegawai_index")->name("pegawai_pegawai");
    Route::get('pegawai/pegawai/add',"PegawaiControl@pegawai_ins")->name("pegawai_pegawai.add");
    Route::post('pegawai/pegawai/add',"PegawaiControl@pegawai_insert")->name("pegawai_pegawai.add_action");
    Route::get('pegawai/pegawai/up/{id}',"PegawaiControl@pegawai_up")->name("pegawai_pegawai.up");
    Route::post('pegawai/pegawai/up/{id}',"PegawaiControl@pegawai_update")->name("pegawai_pegawai.up_action");
    Route::get('pegawai/pegawai/del/{id}',"PegawaiControl@pegawai_delete")->name("pegawai_pegawai.del");
    //Cuti
    Route::get('pegawai/cuti',"PegawaiControl@cuti_index")->name("cuti_pegawai");
    Route::get('pegawai/cuti/add',"PegawaiControl@cuti_ins")->name("cuti_pegawai.add");
    Route::post('pegawai/cuti/add',"PegawaiControl@cuti_insert")->name("cuti_pegawai.add_action");
    Route::get('pegawai/cuti/up/{id}',"PegawaiControl@cuti_up")->name("cuti_pegawai.up");
    Route::post('pegawai/cuti/up/{id}',"PegawaiControl@cuti_update")->name("cuti_pegawai.up_action");
    Route::get('pegawai/cuti/del/{id}',"PegawaiControl@cuti_delete")->name("cuti_pegawai.del");
    //Pensiun
    Route::get('pegawai/pensiun',"PegawaiControl@pensiun_index")->name("pensiun_pegawai");
    Route::get('pegawai/pensiun/add',"PegawaiControl@pensiun_ins")->name("pensiun_pegawai.add");
    Route::post('pegawai/pensiun/add',"PegawaiControl@pensiun_insert")->name("pensiun_pegawai.add_action");
    Route::get('pegawai/pensiun/up/{id}',"PegawaiControl@pensiun_up")->name("pensiun_pegawai.up");
    Route::post('pegawai/pensiun/up/{id}',"PegawaiControl@pensiun_update")->name("pensiun_pegawai.up_action");
    Route::get('pegawai/pensiun/del/{id}',"PegawaiControl@pensiun_delete")->name("pensiun_pegawai.del");
    //Mutasi
    Route::get('pegawai/mutasi',"PegawaiControl@mutasi_index")->name("mutasi_pegawai");
    Route::get('pegawai/mutasi/add',"PegawaiControl@mutasi_ins")->name("mutasi_pegawai.add");
    Route::post('pegawai/mutasi/add',"PegawaiControl@mutasi_insert")->name("mutasi_pegawai.add_action");
    Route::get('pegawai/mutasi/up/{id}',"PegawaiControl@mutasi_up")->name("mutasi_pegawai.up");
    Route::post('pegawai/mutasi/up/{id}',"PegawaiControl@mutasi_update")->name("mutasi_pegawai.up_action");
    Route::get('pegawai/mutasi/del/{id}',"PegawaiControl@mutasi_delete")->name("mutasi_pegawai.del");
    //Kenaikan
    Route::get('pegawai/kenaikan',"PegawaiControl@kenaikan_index")->name("kenaikan_pegawai");
    Route::get('pegawai/kenaikan/add',"PegawaiControl@kenaikan_ins")->name("kenaikan_pegawai.add");
    Route::post('pegawai/kenaikan/add',"PegawaiControl@kenaikan_insert")->name("kenaikan_pegawai.add_action");
    Route::get('pegawai/kenaikan/up/{id}',"PegawaiControl@kenaikan_up")->name("kenaikan_pegawai.up");
    Route::post('pegawai/kenaikan/up/{id}',"PegawaiControl@kenaikan_update")->name("kenaikan_pegawai.up_action");
    Route::get('pegawai/kenaikan/del/{id}',"PegawaiControl@kenaikan_delete")->name("kenaikan_pegawai.del");
});
