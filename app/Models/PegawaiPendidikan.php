<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jul 2019 15:52:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PegawaiPendidikan
 * 
 * @property int $id_pp
 * @property string $nip
 * @property string $tingkat_pend
 * @property string $nama_sekolah
 * @property string $bulan_lulus
 * @property string $tahun_lulus
 * 
 * @property \App\Models\Pegawai $pegawai
 *
 * @package App\Models
 */
class PegawaiPendidikan extends Eloquent
{
	protected $table = 'pegawai_pendidikan';
	protected $primaryKey = 'id_pp';
	public $timestamps = false;

	protected $fillable = [
		'nip',
		'tingkat_pend',
		'nama_sekolah',
		'bulan_lulus',
		'tahun_lulus'
	];

	public function pegawai()
	{
		return $this->belongsTo(\App\Models\Pegawai::class, 'nip');
	}
}
