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

use StingerSoft\PlatformBundle\Tests\TestCase;

class GroupTest extends TestCase {

	public function testBasicGroupStuff() {
		$group = new Group('mygroup');
		
		$this->assertEquals('mygroup', $group->getName());
		$this->assertEmpty($group->getUsers());
		$this->assertEmpty($group->getRoles());
	}

	public function testGroupRoles() {
		$group = new Group('mygroup', array(
			'1',
			'2' 
		));
		$this->assertNotEmpty($group->getRoles());
		$this->assertContains('1', $group->getRoles());
		$this->assertContains('2', $group->getRoles());
		
		$group->addRole('3');
		$this->assertContains('3', $group->getRoles());
		
		$group->addRoles(array(
			'4',
			'5' 
		));
		$this->assertContains('4', $group->getRoles());
		$this->assertContains('5', $group->getRoles());
		
		$group->removeRole('5');
		$this->assertNotContains('5', $group->getRoles());
		
		$group->removeRoles(array(
			'5' 
		));
		$this->assertNotContains('5', $group->getRoles());
		
		$group->removeRoles(array(
			'5',
			'4',
			'3' 
		));
		$this->assertNotContains('5', $group->getRoles());
		$this->assertNotContains('4', $group->getRoles());
		$this->assertNotContains('3', $group->getRoles());
		
		$group->removeRoles(array(
			'2',
			'1' 
		));
		$this->assertNotContains('2', $group->getRoles());
		$this->assertNotContains('1', $group->getRoles());
		$this->assertEmpty($group->getRoles());
	}

	public function testGroupUsers() {
		$group = new Group('mygroup');
		
		$this->assertEmpty($group->getUsers());
		$this->assertEquals(0, $group->getUsersCount());
		$user = new User();
		$user->setFirstname('Peter')->setSurname('Mobb');
		
		$group->addUser($user);
		$this->assertNotEmpty($group->getUsers());
		$this->assertContains($user, $group->getUsers());
		$this->assertEquals(1, $group->getUsersCount());
		
		$group->removeUser($user);
		$this->assertNotContains($user, $group->getUsers());
		$this->assertEmpty($group->getUsers());
		$this->assertEquals(0, $group->getUsersCount());
	}
}
