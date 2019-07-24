<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 02 Jul 2019 19:07:43 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Divisi
 * 
 * @property int $id_divisi
 * @property string $nama_divisi
 * 
 * @property \Illuminate\Database\Eloquent\Collection $kenaikans
 * @property \Illuminate\Database\Eloquent\Collection $mutasis
 * @property \Illuminate\Database\Eloquent\Collection $pegawais
 *
 * @package App\Models
 */
class Divisi extends Eloquent
{
	protected $table = 'divisi';
	protected $primaryKey = 'id_divisi';
	public $timestamps = false;

	protected $fillable = [
		'nama_divisi'
	];

	public function kenaikans()
	{
		return $this->hasMany(\App\Models\Kenaikan::class, 'tujuan');
	}

	public function mutasis()
	{
		return $this->hasMany(\App\Models\Mutasi::class, 'tujuan');
	}

	public function pegawais()
	{
		return $this->hasMany(\App\Models\Pegawai::class, 'id_divisi');
	}
}
