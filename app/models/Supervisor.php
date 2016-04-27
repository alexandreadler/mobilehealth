<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;

/**
 * User
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $confirmation_code
 * @property string $remember_token
 * @property boolean $confirmed
 * @property string $ultimo_acesso
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Supervisor whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Supervisor whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\Supervisor whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Supervisor wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\Supervisor whereConfirmationCode($value)
 * @method static \Illuminate\Database\Query\Builder|\Supervisor whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\Supervisor whereConfirmed($value)
 * @method static \Illuminate\Database\Query\Builder|\Supervisor whereUltimoAcesso($value)
 * @method static \Illuminate\Database\Query\Builder|\Supervisor whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Supervisor whereUpdatedAt($value)
 */
class Supervisor extends Eloquent implements ConfideUserInterface
{
	use ConfideUser;

	/**
	 * Validation rules
	 */

	public static $rules = array(
		'email' => 'required|email',
		'password' => 'required|between:4,11|confirmed',
	);


	public function person() {
		return $this->hasOne('Person','id','person_id');
	}


}