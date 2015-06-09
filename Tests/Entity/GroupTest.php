<?php
/**
 * Created by PhpStorm.
 * User: kodde
 * Date: 10.06.2015
 * Time: 00:19
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
		$group = new Group('mygroup', array('1', '2'));
		$this->assertNotEmpty($group->getRoles());
		$this->assertContains('1', $group->getRoles());
		$this->assertContains('2', $group->getRoles());

		$group->addRole('3');
		$this->assertContains('3', $group->getRoles());

		$group->addRoles(array('4', '5'));
		$this->assertContains('4', $group->getRoles());
		$this->assertContains('5', $group->getRoles());

		$group->removeRole('5');
		$this->assertNotContains('5', $group->getRoles());

		$group->removeRoles(array('5'));
		$this->assertNotContains('5', $group->getRoles());

		$group->removeRoles(array('5', '4', '3'));
		$this->assertNotContains('5', $group->getRoles());
		$this->assertNotContains('4', $group->getRoles());
		$this->assertNotContains('3', $group->getRoles());

		$group->removeRoles(array('2', '1'));
		$this->assertNotContains('2', $group->getRoles());
		$this->assertNotContains('1', $group->getRoles());
		$this->assertEmpty($group->getRoles());
	}

	public function testGroupUsers() {
		$group = new Group('mygroup');

		$this->assertEmpty($group->getUsers());
		$user = new User();
		$user->setFirstname('Peter')->setSurname('Mobb');

		$group->addUser($user);
		$this->assertNotEmpty($group->getUsers());
		$this->assertContains($user, $group->getUsers());

		$group->removeUser($user);
		$this->assertNotContains($user, $group->getUsers());
		$this->assertEmpty($group->getUsers());
	}
}
