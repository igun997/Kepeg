<?php

namespace App\Http\Controllers;
use App\Models\Pegawai;
use App\Models\Admin;
use Illuminate\Http\Request;

class LoginControl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pegawai()
    {
        return view("app.layout_login_pegawai");
    }
    public function admin()
    {
        return view("app.layout_login_admin");
    }
    public function login_pegawai(Request $req)
    {
      $data = $req->all();
      unset($data["_token"]);
      $x = Pegawai::where(["nip"=>$data["nip"],"password"=>$data["password"]]);
      if ($x->count() > 0) {
        $push = [];
        $push["nip"] = $x->first()->nip;
        $push["level"] = "pegawai";
        set($push);
        return redirect("pegawai");
      }else {
        $x = Admin::where(["username"=>$data["nip"],"password"=>$data["password"]]);
        if ($x->count() > 0) {
          $push = ((array)$x->first());
          $push["level"] = "admin";
          if ($x->first()->akses == "atasan") {
            $push["level"] = "atasan";
          }
          set($push);
          return redirect("admin");
        }else {
          return back()->withErrors(["msg"=>"NIP / Username dan Password Salah"]);
        }
      }
    }
    public function login_admin(Request $req)
    {
      $data = $req->all();
      unset($data["_token"]);
      $x = Admin::where($data);
      if ($x->count() > 0) {
        $push = ((array)$x->first());
        $push["level"] = "admin";
        if ($x->first()->akses == "atasan") {
          $push["level"] = "atasan";
        }
        set($push);
        return redirect("admin");
      }else {
        return back()->withErrors(["msg"=>"Username dan Password Salah"]);
      }
    }

}
