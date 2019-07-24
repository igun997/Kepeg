<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jul 2019 15:52:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SubBagian
 * 
 * @property int $id_sub_bagian
 * @property int $id_bagian
 * @property string $nama_sub
 * 
 * @property \App\Models\Bagian $bagian
 * @property \Illuminate\Database\Eloquent\Collection $pegawais
 *
 * @package App\Models
 */
class SubBagian extends Eloquent
{
	protected $table = 'sub_bagian';
	protected $primaryKey = 'id_sub_bagian';
	public $timestamps = false;

	protected $casts = [
		'id_bagian' => 'int'
	];

	protected $fillable = [
		'id_bagian',
		'nama_sub'
	];

	public function bagian()
	{
		return $this->belongsTo(\App\Models\Bagian::class, 'id_bagian');
	}

	public function pegawais()
	{
		return $this->hasMany(\App\Models\Pegawai::class, 'id_sub_bagian');
	}
}
