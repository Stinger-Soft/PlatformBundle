<?php
/**
 * Created by PhpStorm.
 * User: kodde
 * Date: 09.06.2015
 * Time: 23:58
 */

namespace StingerSoft\PlatformBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 *
 * $LastChangedBy: $
 * $LastChangedDate: $
 *
 * Class User
 *
 * @package StingerSoft\PlatformBundle\Entity
 */
class User extends BaseUser implements Identifiable {

	/**
	 *
	 * @var integer
	 */
	protected $id;

	/**
	 *
	 * @var string
	 */
	protected $firstname;

	/**
	 *
	 * @var string
	 */
	protected $surname;

	/**
	 * @return string
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * @param string $firstname
	 *
	 * @return $this
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getSurname() {
		return $this->surname;
	}

	/**
	 * @param string $surname
	 *
	 * @return $this
	 */
	public function setSurname($surname) {
		$this->surname = $surname;

		return $this;
	}

	/**
	 * Get realname "Firstname Surname"
	 *
	 * @return string
	 */
	public function getRealName() {
		if($this->firstname || $this->surname) {
			return $this->getFirstname() . ' ' . $this->getSurname();
		}
		return null;
	}

	/**
	 *
	 * @return string - "Username" ("Firstname Surname")
	 */
	public function getUsernameAndRealName() {
		return $this->getUsername() . ' (' . $this->getRealName() . ')';
	}

	/**
	 * @return string "Surname, Firstname"|"Surname"
	 */
	public function getReversedRealName() {
		if($this->getFirstname()) {
			return $this->getSurname() . ', ' . $this->getFirstname();
		} else {
			return $this->getSurname();
		}
	}

	/**
	 * @return string "Firstname Surname"|"Username"
	 */
	public function __toString() {
		return $this->getRealName() != null ? $this->getRealName() : $this->getUsername();
	}
}