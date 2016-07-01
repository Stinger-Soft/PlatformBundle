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
namespace StingerSoft\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Translation\TranslatorInterface;
use Doctrine\Common\Persistence\ObjectRepository;

class BaseController extends Controller {

	/**
	 * Returns the default locale for the system
	 *
	 * @return string
	 */
	protected function getDefaultLocale() {
		return 'en';
	}

	/**
	 * Returns all available (i.e.
	 * configured) locales of the system
	 *
	 * @return string[]
	 */
	protected function getLocales() {
		return array(
			'en' 
		);
	}

	/**
	 * Proxy to use the transChoice method of the translator
	 *
	 * @see TranslatorInterface::transChoice()
	 *
	 * @param string $id        	
	 * @param int $number        	
	 * @param array $parameters        	
	 * @param string $domain        	
	 * @param string $locale        	
	 * @return string
	 */
	protected function transChoice($id, $number, array $parameters = array(), $domain = null, $locale = null) {
		/**
		 *
		 * @var TranslatorInterface $translator
		 */
		$translator = $this->getTranslator();
		return $translator->transChoice($id, $number, $parameters, $domain, $locale);
	}

	/**
	 * Proxy to use the transChoice method of the translator
	 *
	 * @see TranslatorInterface::trans()
	 *
	 * @param string $id        	
	 * @param array $parameters        	
	 * @param string $domain        	
	 * @param string $locale        	
	 * @return string
	 */
	protected function trans($id, array $parameters = array(), $domain = null, $locale = null) {
		/**
		 *
		 * @var TranslatorInterface $translator
		 */
		$translator = $this->getTranslator();
		return $translator->trans($id, $parameters, $domain, $locale);
	}

	/**
	 * Returns the translator service
	 *
	 * @return TranslatorInterface
	 */
	protected function getTranslator() {
		return $this->get('translator');
	}

	/**
	 * Returns the paginator service
	 *
	 * @return \Knp\Component\Pager\PaginatorInterface
	 */
	protected function getPaginator() {
		return $this->get('knp_paginator');
	}

	/**
	 * Returns the stopwatch service if available
	 *
	 * @return Stopwatch|NULL
	 */
	protected function getStopWatch() {
		if($this->has('debug.stopwatch')) {
			return $this->get('debug.stopwatch');
		}
		return null;
	}

	/**
	 * Checks whether the current user has the specified role or not
	 *
	 * @param string $role        	
	 * @throws \LogicException
	 * @return boolean
	 */
	protected function hasRole($role) {
		if(!$this->container->has('security.authorization_checker')) {
			throw new \LogicException('The SecurityBundle is not registered in your application.');
		}
		return false !== $this->get('security.authorization_checker')->isGranted($role);
	}

	/**
	 * Returns the repository for the given clazz
	 * 
	 * @param string $class
	 * @return ObjectRepository
	 */
	protected function getRepository($class) {
		return $this->getDoctrine()->getManagerForClass($class)->getRepository($class);
	}
}