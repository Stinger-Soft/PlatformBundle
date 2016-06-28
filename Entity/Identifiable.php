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
namespace StingerSoft\PlatformBundle\Entity;

/**
 *
 * $LastChangedBy: $
 * $LastChangedDate: $
 *
 * Interface Identifiable
 *
 * @package StingerSoft\PlatformBundle\Entity
 */
interface Identifiable {

	/**
	 *
	 * @return mixed
	 */
	public function getId();
}