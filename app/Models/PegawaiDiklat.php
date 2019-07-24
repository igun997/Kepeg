<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jul 2019 15:52:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PegawaiDiklat
 *
 * @property int $id_pd
 * @property string $nip
 * @property string $nama_diklat
 * @property string $bulan
 * @property \Carbon\Carbon $tahun
 *
 * @property \App\Models\Pegawai $pegawai
 *
 * @package App\Models
 */
class PegawaiDiklat extends Eloquent
{
	protected $table = 'pegawai_diklat';
	protected $primaryKey = 'id_pd';
	public $timestamps = false;

	

	protected $fillable = [
		'nip',
		'nama_diklat',
		'bulan',
		'tahun'
	];

	public function pegawai()
	{
		return $this->belongsTo(\App\Models\Pegawai::class, 'nip');
	}
}
