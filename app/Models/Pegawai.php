<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jul 2019 15:52:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pegawai
 *
 * @property string $nip
 * @property string $password
 * @property int $id_gol
 * @property int $id_sub_bagian
 * @property string $nama_pegawai
 * @property string $no_hp
 * @property string $tempat_lahir
 * @property \Carbon\Carbon $tgl_lahir
 * @property string $jk
 * @property string $agama
 * @property string $jabatan
 * @property string $status_perkawinan
 * @property string $status_pegawai
 * @property string $jenis
 * @property \Carbon\Carbon $mulai_kerja
 *
 * @property \App\Models\Gol $gol
 * @property \App\Models\SubBagian $sub_bagian
 * @property \Illuminate\Database\Eloquent\Collection $cutis
 * @property \Illuminate\Database\Eloquent\Collection $kenaikans
 * @property \Illuminate\Database\Eloquent\Collection $mutasis
 * @property \Illuminate\Database\Eloquent\Collection $pegawai_diklats
 * @property \Illuminate\Database\Eloquent\Collection $pegawai_pendidikans
 * @property \Illuminate\Database\Eloquent\Collection $pensiuns
 *
 * @package App\Models
 */
class Pegawai extends Eloquent
{
	protected $table = 'pegawai';
	protected $primaryKey = 'nip';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_gol' => 'int',
		'id_sub_bagian' => 'int'
	];

	protected $dates = [
		'tgl_lahir',
		'mulai_kerja'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'nip',
		'password',
		'id_gol',
		'id_sub_bagian',
		'nama_pegawai',
		'no_hp',
		'tempat_lahir',
		'tgl_lahir',
		'jk',
		'agama',
		'jabatan',
		'status_perkawinan',
		'status_pegawai',
		'jenis',
		'mulai_kerja'
	];

	public function gol()
	{
		return $this->belongsTo(\App\Models\Gol::class, 'id_gol');
	}

	public function sub_bagian()
	{
		return $this->belongsTo(\App\Models\SubBagian::class, 'id_sub_bagian');
	}

	public function cutis()
	{
		return $this->hasMany(\App\Models\Cuti::class, 'nip');
	}

	public function kenaikans()
	{
		return $this->hasMany(\App\Models\Kenaikan::class, 'nip');
	}

	public function mutasis()
	{
		return $this->hasMany(\App\Models\Mutasi::class, 'nip');
	}

	public function pegawai_diklats()
	{
		return $this->hasMany(\App\Models\PegawaiDiklat::class, 'nip');
	}

	public function pegawai_pendidikans()
	{
		return $this->hasMany(\App\Models\PegawaiPendidikan::class, 'nip');
	}

	public function pensiuns()
	{
		return $this->hasMany(\App\Models\Pensiun::class, 'nip');
	}
}
