<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jul 2019 15:52:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Kenaikan
 *
 * @property int $id_kenaikan
 * @property string $nip
 * @property \Carbon\Carbon $tanggal
 * @property string $jenis
 * @property string $berkas
 * @property int $asal
 * @property int $tujuan
 * @property string $status
 * @property string $status_kenaikan
 *
 * @property \App\Models\Gol $gol
 * @property \App\Models\Pegawai $pegawai
 *
 * @package App\Models
 */
class Kenaikan extends Eloquent
{
	protected $table = 'kenaikan';
	protected $primaryKey = 'id_kenaikan';
	public $timestamps = false;

	protected $casts = [
		'asal' => 'int',
		'tujuan' => 'int'
	];

	protected $dates = [
		'tanggal'
	];

	protected $fillable = [
		'nip',
		'tanggal',
		'jenis',
		'berkas',
		'asal',
		'tujuan',
		'status',
		'status_kenaikan'
	];

	public function gol_tujuan()
	{
		return $this->belongsTo(\App\Models\Gol::class, 'tujuan');
	}
	public function gol_asal()
	{
		return $this->belongsTo(\App\Models\Gol::class, 'asal');
	}

	public function pegawai()
	{
		return $this->belongsTo(\App\Models\Pegawai::class, 'nip');
	}
}
