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
	 *
	 * @param
	 *        	mixed the user representation
	 * @return $this
	 */
	public function setCreatedBy($user);

	/**
	 *
	 * @param
	 *        	mixed the user representation
	 * @return $this
	 */
	public function setUpdatedBy($user);

	/**
	 *
	 * @return mixed the user who created entity
	 */
	public function getCreatedBy();

	/**
	 *
	 * @return mixed the user who last updated entity
	 */
	public function getUpdatedBy();

	/**
	 * Returns createdAt value.
	 *
	 * @return \DateTime
	 */
	public function getCreatedAt();

	/**
	 * Returns updatedAt value.
	 *
	 * @return \DateTime
	 */
	public function getUpdatedAt();

	/**
	 *
	 * @param \DateTime $createdAt        	
	 * @return $this
	 */
	public function setCreatedAt(\DateTime $createdAt);

	/**
	 *
	 * @param \DateTime $updatedAt        	
	 * @return $this
	 */
	public function setUpdatedAt(\DateTime $updatedAt);
}