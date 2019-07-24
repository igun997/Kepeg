<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jul 2019 15:52:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pensiun
 * 
 * @property int $id_pensiun
 * @property string $nip
 * @property \Carbon\Carbon $tanggal
 * @property string $pensiun
 * @property string $keterangan
 * @property string $berkas
 * @property string $status
 * @property string $status_pensiun
 * 
 * @property \App\Models\Pegawai $pegawai
 *
 * @package App\Models
 */
class Pensiun extends Eloquent
{
	protected $table = 'pensiun';
	protected $primaryKey = 'id_pensiun';
	public $timestamps = false;

	protected $dates = [
		'tanggal'
	];

	protected $fillable = [
		'nip',
		'tanggal',
		'pensiun',
		'keterangan',
		'berkas',
		'status',
		'status_pensiun'
	];

	public function pegawai()
	{
		return $this->belongsTo(\App\Models\Pegawai::class, 'nip');
	}
}
