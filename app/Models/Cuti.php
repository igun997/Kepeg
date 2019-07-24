<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jul 2019 15:52:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Cuti
 * 
 * @property int $id_cuti
 * @property string $nip
 * @property \Carbon\Carbon $tgl_cuti
 * @property \Carbon\Carbon $tgl_selesai
 * @property string $jns_cuti
 * @property string $status
 * @property string $status_cuti
 * @property string $berkas
 * 
 * @property \App\Models\Pegawai $pegawai
 *
 * @package App\Models
 */
class Cuti extends Eloquent
{
	protected $table = 'cuti';
	protected $primaryKey = 'id_cuti';
	public $timestamps = false;

	protected $dates = [
		'tgl_cuti',
		'tgl_selesai'
	];

	protected $fillable = [
		'nip',
		'tgl_cuti',
		'tgl_selesai',
		'jns_cuti',
		'status',
		'status_cuti',
		'berkas'
	];

	public function pegawai()
	{
		return $this->belongsTo(\App\Models\Pegawai::class, 'nip');
	}
}
