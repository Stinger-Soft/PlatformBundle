<?php
/**
 * Created by PhpStorm.
 * User: kodde
 * Date: 09.06.2015
 * Time: 23:29
 */
use StingerSoft\PlatformBundle\DependencyInjection\StingerSoftPlatformExtension;
use StingerSoft\PlatformBundle\StingerSoftPlatformBundle;
use Symfony\Component\DependencyInjection\Compiler\ResolveDefinitionTemplatesPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

/**
 *
 * $LastChangedBy: $
 * $LastChangedDate: $
 *
 * Class TestCase
 */
class TestCase extends \PHPUnit_Framework_TestCase {


	public function createContainer() {
		$container = new ContainerBuilder(new ParameterBag(array(
			'kernel.debug'       => false,
//			'kernel.bundles'     => array('YamlBundle' => 'Fixtures\Bundles\YamlBundle\YamlBundle'),
			'kernel.cache_dir'   => sys_get_temp_dir(),
			'kernel.environment' => 'test',
			'kernel.root_dir'    => __DIR__ . '/../../../../', // src dir
		)));
		$extension = new StingerSoftPlatformExtension();
		$container->registerExtension($extension);
		$extension->load(array(), $container);

		$bundle = new StingerSoftPlatformBundle();
		$bundle->build($container);

		$container->getCompilerPassConfig()->setOptimizationPasses(array(new ResolveDefinitionTemplatesPass()));
		$container->getCompilerPassConfig()->setRemovingPasses(array());
		$container->compile();


		return $container;
	}

}