<?php

/*
 * This file is part of the Stinger Soft Platform package.
 *
 * (c) Oliver Kotte <oliver.kotte@stinger-soft.net>
 * (c) Florian Meyer <florian.meyer@stinger-soft.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace StingerSoft\PlatformBundle\Model;

interface Trackable {

	/**
	 * @param mixed the user representation
	 * @return $this
	 */
	public function setCreatedBy($user);
	
	/**
	 * @param mixed the user representation
	 * @return $this
	 */
	public function setUpdatedBy($user);
	
	/**
	 * @param mixed the user representation
	 * @return $this
	 */
	public function setDeletedBy($user);
	
	/**
	 * @return mixed the user who created entity
	 */
	public function getCreatedBy();
	
	/**
	 * @return mixed the user who last updated entity
	 */
	public function getUpdatedBy();
}