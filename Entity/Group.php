<?php
/**
 * Created by PhpStorm.
 * User: kodde
 * Date: 09.06.2015
 * Time: 23:58
 */

namespace StingerSoft\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\Group as BaseGroup;

/**
 *
 * $LastChangedBy: $
 * $LastChangedDate: $
 *
 * Class Group
 *
 * @package StingerSoft\PlatformBundle\Entity
 */
class Group extends BaseGroup implements Identifiable {

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 */
	protected $users;

	/**
	 * Constructor
	 *
	 * @param       $name
	 * @param array $roles
	 */
	public function __construct($name, $roles = array()) {
		$this->users = new ArrayCollection();
		parent::__construct($name, $roles);
	}

	public function addRoles(array $roles) {
		foreach ($roles as $role) {
			$this->addRole($role);
		}
	}

	public function removeRoles(array $roles) {
		foreach ($roles as $role) {
			$this->removeRole($role);
		}
	}

	/**
	 * Add user
	 *
	 * @param User $user
	 *
	 * @return Group
	 */
	public function addUser(User $user) {
		$this->users[] = $user;

		return $this;
	}

	/**
	 * Remove user
	 *
	 * @param User $user
	 */
	public function removeUser(User $user) {
		$this->users->removeElement($user);
	}

	/**
	 * Get users
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getUsers() {
		return $this->users;
	}

	public function getUsersCount() {
		return $this->users->count();
	}

}