<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 22 Jul 2019 15:52:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Admin
 *
 * @property string $username
 * @property string $password
 * @property string $akses
 *
 * @package App\Models
 */
class Admin extends Eloquent
{
	protected $table = 'admin';
	protected $primaryKey = 'username';
	public $incrementing = false;
	public $timestamps = false;

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'password',
		'username',
		'akses'
	];
}
