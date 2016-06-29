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
namespace StingerSoft\PlatformBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class StingerSoftPlatformBundle extends Bundle {

	public static function getRequiredBundles($env) {
		$bundles = [];
		$bundles['FrameworkBundle'] = '\Symfony\Bundle\FrameworkBundle\FrameworkBundle';
		$bundles['SecurityBundle'] = '\Symfony\Bundle\SecurityBundle\SecurityBundle';
		$bundles['TwigBundle'] = '\Symfony\Bundle\TwigBundle\TwigBundle';
		$bundles['MonologBundle'] = '\Symfony\Bundle\MonologBundle\MonologBundle';
		$bundles['SwiftmailerBundle'] = '\Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle';
		$bundles['DoctrineBundle'] = '\Doctrine\Bundle\DoctrineBundle\DoctrineBundle';
		$bundles['DoctrineFixturesBundle'] = '\Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle';
		$bundles['SensioFrameworkExtraBundle'] = '\Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle';
		$bundles['DoctrineBehaviorsBundle'] = '\Knp\DoctrineBehaviors\Bundle\DoctrineBehaviorsBundle';
		
		if(in_array($env, [
			'dev',
			'test' 
		], true)) {
			$bundles['DebugBundle'] = '\Symfony\Bundle\DebugBundle\DebugBundle';
			$bundles['WebProfilerBundle'] = '\Symfony\Bundle\WebProfilerBundle\WebProfilerBundle';
			$bundles['SensioDistributionBundle'] = '\Sensio\Bundle\DistributionBundle\SensioDistributionBundle';
			$bundles['SensioGeneratorBundle'] = '\Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle';
		}
		return $bundles;
	}
	
	
	public static function initBundles(array $bundles){
		$result = [];
		foreach($bundles as $bundle){
			$result[] = new $bundle;
		}
		return $result;
	}
}
