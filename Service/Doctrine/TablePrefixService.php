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
namespace StingerSoft\PlatformBundle\Service\Doctrine;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

/**
 *
 * Doctrine event subscriber to add a prefix to each database table based on the bundle name
 *
 * @author Florian Meyer <florian.meyer@stinger-soft.net>
 *        
 */
class TablePrefixService implements EventSubscriber {

	const SERVICE_ID = 'stinger_soft_platform.doctrine.table_prefix';

	public function getSubscribedEvents() {
		return array(
			'loadClassMetadata' 
		);
	}

	/**
	 *
	 * @param LoadClassMetadataEventArgs $args        	
	 */
	public function loadClassMetadata(LoadClassMetadataEventArgs $args) {
		$classMetadata = $args->getClassMetadata();
		
		// Do not re-apply the prefix in an inheritance hierarchy.
		if($classMetadata->isInheritanceTypeSingleTable() && !$classMetadata->isRootEntity()) {
			return;
		}
		
		$prefix = $classMetadata->namespace;
		if(!preg_match('/([^\\\\]+)Bundle/i', $classMetadata->namespace, $prefix)) {
			return;
		}
		// Can this happen??
		// if(count($prefix)!=2){
		// return;
		// }
		$prefix = strtolower($prefix[1]) . '_';
		
		$classMetadata->setPrimaryTable(array(
			'name' => $prefix . $classMetadata->getTableName() 
		));
		
		foreach($classMetadata->getAssociationMappings() as $fieldName => $mapping) {
			if($mapping['type'] == ClassMetadataInfo::MANY_TO_MANY && isset($classMetadata->associationMappings[$fieldName]['joinTable']['name'])) {
				if(isset($classMetadata->associationMappings[$fieldName]['joinTable']['prefixed']) && $classMetadata->associationMappings[$fieldName]['joinTable']['prefixed']) {
					continue;
				}
				
				$mappedTableName = $classMetadata->associationMappings[$fieldName]['joinTable']['name'];
				$classMetadata->associationMappings[$fieldName]['joinTable']['name'] = $prefix . $mappedTableName;
				$classMetadata->associationMappings[$fieldName]['joinTable']['prefixed'] = true;
			}
		}
	}
}