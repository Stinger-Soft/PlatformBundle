<?php

/*
 * This file is part of the Stinger Platform package.
*
* (c) Oliver Kotte <oliver.kotte@stinger-soft.net>
* (c) Florian Meyer <florian.meyer@stinger-soft.net>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/
namespace StingerSoft\PlatformBundle\Tests\Service\Doctrine;

use StingerSoft\PlatformBundle\Tests\TestCase;
use StingerSoft\PlatformBundle\Service\Doctrine\TablePrefixService;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

class TablePrefixServiceTest extends TestCase{
	
	
	public static $assocMappingBefore =  array(
			'groups' => array(
					'type' => ClassMetadataInfo::MANY_TO_MANY,
					'joinTable' => array(
							'name' => 'user_group',
							'prefixed' => false,
					)
			) 
	);
	
	public static $assocMappingAfter =  array(
			'groups' => array(
					'type' => ClassMetadataInfo::MANY_TO_MANY,
					'joinTable' => array(
							'name' => 'platform_user_group',
							'prefixed' => true,
					)
			)
	);

	/**
	 *
	 * @var TablePrefixService
	 */
	protected $prefixService;
	
	public function setUp(){
		$this->prefixService = $this->createContainer()->get(TablePrefixService::SERVICE_ID);
	}
	
	
	public function testService(){
		$this->assertInstanceOf('StingerSoft\PlatformBundle\Service\Doctrine\TablePrefixService', $this->prefixService);
	}
	
	public function testSubscribedEvents(){
		$this->assertArraySubset(array('loadClassMetadata'), $this->prefixService->getSubscribedEvents());
	}
	
	

	public function testSingleInheritanceWithoutRoot(){
		$cm = $this->mockEventArgs();
		$cm->method('isInheritanceTypeSingleTable')->will($this->returnValue(true));
		$cm->method('isRootEntity')->will($this->returnValue(false));
		
		$om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
		$args = new LoadClassMetadataEventArgs($cm, $om);
		$this->assertNull($this->prefixService->loadClassMetadata($args));
		$this->assertEquals($cm->associationMappings, self::$assocMappingBefore);
	}
	
	public function testloadClassMetadata(){
		$cm = $this->mockEventArgs();
		$cm->method('isInheritanceTypeSingleTable')->will($this->returnValue(true));
		$cm->method('isRootEntity')->will($this->returnValue(true));
		
	
		$om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
		$args = new LoadClassMetadataEventArgs($cm, $om);
		$this->assertNull($this->prefixService->loadClassMetadata($args));
		$this->assertEquals($cm->associationMappings, self::$assocMappingAfter);
	}
	
	public function testInvalidNamespace(){
		$cm = $this->mockEventArgs();
		$cm->method('isInheritanceTypeSingleTable')->will($this->returnValue(true));
		$cm->method('isRootEntity')->will($this->returnValue(true));
		$cm->namespace = 'Test';
		
		$om = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
		$args = new LoadClassMetadataEventArgs($cm, $om);
		$this->assertNull($this->prefixService->loadClassMetadata($args));
		$this->assertEquals($cm->associationMappings, self::$assocMappingBefore);
	}
	
	
	protected function mockEventArgs(){
		$cm = $this->getMockBuilder('Doctrine\ORM\Mapping\ClassMetadata')
			->setConstructorArgs(array('StingerSoftPlatform:User'))
			->getMock();
		$cm->namespace = 'StingerSoft\PlatformBundle\Entity\User';
		$cm->associationMappings = self::$assocMappingBefore;
		$cm->method('getAssociationMappings')->will($this->returnValue($cm->associationMappings));
		return $cm;
	}
	
}