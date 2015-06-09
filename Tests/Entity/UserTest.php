<?php
/**
 * Created by PhpStorm.
 * User: kodde
 * Date: 10.06.2015
 * Time: 00:09
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
