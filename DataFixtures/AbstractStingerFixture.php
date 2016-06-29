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
namespace StingerSoft\PlatformBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

abstract class AbstractStingerFixture extends AbstractFixture implements DependentFixtureInterface {
	
	use ContainerAwareTrait;

	/**
	 *
	 * @var ObjectManager
	 */
	protected $manager;

	/**
	 *
	 * @var LoggerInterface
	 */
	private $logger;

	public final function load(ObjectManager $manager) {
		$this->manager = $manager;
		if(!$this->skipMe()) {
			$this->info("Starting import of fixtures ...");
			$this->reportMemoryUsage();
// 			$startTime = microtime(true);
			$this->import();
// 			$endTime = microtime(true);
// 			$this->info("Finished importing fixtures in " . $this->formatTime($startTime, $endTime));
			$this->reportMemoryUsage();
		} else {
			$this->info('Skipping import of fixtures !');
		}
	}

	protected final function reportMemoryUsage() {
		$this->info("Currently using %s of RAM", $this->getMemoryUsage());
	}

	/**
	 * Load data fixtures
	 */
	protected abstract function import();

	/**
	 * Decides whether this fixture should be skipped or not.
	 *
	 * @return bool
	 */
	protected function skipMe() {
		return false;
	}
	

	/**
	 *
	 * @return LoggerInterface|null
	 */
	protected function getLogger() {
		if(!$this->logger && $this->container && $this->container->has('logger')) {
			$this->logger = $this->container->get('logger');
		} else {
			$this->logger = new NullLogger();
		}
		return $this->logger;
	}

	/**
	 */
	protected function getDependencies() {
	}
}