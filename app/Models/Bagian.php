<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jul 2019 15:52:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Bagian
 * 
 * @property int $id_bagian
 * @property string $nama_divisi
 * 
 * @property \Illuminate\Database\Eloquent\Collection $mutasis
 * @property \Illuminate\Database\Eloquent\Collection $sub_bagians
 *
 * @package App\Models
 */
class Bagian extends Eloquent
{
	protected $table = 'bagian';
	protected $primaryKey = 'id_bagian';
	public $timestamps = false;

	protected $fillable = [
		'nama_divisi'
	];

	public function mutasis()
	{
		return $this->hasMany(\App\Models\Mutasi::class, 'tujuan');
	}

	public function sub_bagians()
	{
		return $this->hasMany(\App\Models\SubBagian::class, 'id_bagian');
	}
}
