<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jul 2019 15:52:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Gol
 * 
 * @property int $id_gol
 * @property string $nama_gol
 * @property string $pangkat
 * 
 * @property \Illuminate\Database\Eloquent\Collection $kenaikans
 * @property \Illuminate\Database\Eloquent\Collection $pegawais
 *
 * @package App\Models
 */
class Gol extends Eloquent
{
	protected $table = 'gol';
	protected $primaryKey = 'id_gol';
	public $timestamps = false;

	protected $fillable = [
		'nama_gol',
		'pangkat'
	];

	public function kenaikans()
	{
		return $this->hasMany(\App\Models\Kenaikan::class, 'tujuan');
	}

	public function pegawais()
	{
		return $this->hasMany(\App\Models\Pegawai::class, 'id_gol');
	}
}
