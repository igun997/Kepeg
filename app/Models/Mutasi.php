<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 23 Jul 2019 11:46:26 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Mutasi
 *
 * @property int $id_mutasi
 * @property string $nip
 * @property \Carbon\Carbon $tgl_mutasi
 * @property int $asal
 * @property int $tujuan
 * @property string $berkas
 * @property string $status_validasi
 * @property string $status_mutasi
 *
 * @property \App\Models\SubBagian $sub_bagian
 * @property \App\Models\Pegawai $pegawai
 *
 * @package App\Models
 */
class Mutasi extends Eloquent
{
	protected $table = 'mutasi';
	protected $primaryKey = 'id_mutasi';
	public $timestamps = false;

	protected $casts = [
		'asal' => 'int',
		'tujuan' => 'int'
	];

	protected $dates = [
		'tgl_mutasi'
	];

	protected $fillable = [
		'nip',
		'tgl_mutasi',
		'asal',
		'tujuan',
		'berkas',
		'status_validasi',
		'status_mutasi'
	];

	public function sub_bagian_tujuan()
	{
		return $this->belongsTo(\App\Models\SubBagian::class, 'tujuan');
	}
	public function sub_bagian_asal()
	{
		return $this->belongsTo(\App\Models\SubBagian::class, 'asal');
	}

	public function pegawai()
	{
		return $this->belongsTo(\App\Models\Pegawai::class, 'nip');
	}
}
