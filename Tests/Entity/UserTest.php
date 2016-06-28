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
namespace StingerSoft\PlatformBundle\Entity\User;

use StingerSoft\PlatformBundle\Entity\User;
use StingerSoft\PlatformBundle\Tests\TestCase;

class UserTest extends TestCase {

	public function testBasicUserStuff() {
		$user = new User();
		
		$this->assertEquals('', $user->getFirstname());
		$this->assertEquals('', $user->getSurname());
		$this->assertEquals('', $user->getUsername());
		
		$user->setUsername('pmobb');
		$this->assertEquals('pmobb', $user->getUsername());
		$this->assertEquals('pmobb', strval($user));
		
		$user->setSurname('Mobb');
		$this->assertEquals('Mobb', $user->getSurname());
		$this->assertEquals('Mobb', $user->getReversedRealName());
		
		$user->setFirstname('Peter');
		$this->assertEquals('Peter', $user->getFirstname());
		
		$this->assertEquals('Peter Mobb', $user->__toString());
		$this->assertEquals('Peter Mobb', $user->getRealName());
		$this->assertEquals('Mobb, Peter', $user->getReversedRealName());
		$this->assertEquals('pmobb (Peter Mobb)', $user->getUsernameAndRealName());
	}
}
