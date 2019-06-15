<?php declare(strict_types=1);

namespace App\Tests\Integration;

use App\Framework\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class IntegrationKernel extends Kernel
{
    public function __construct()
    {
        parent::__construct('test', true);
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        parent::configureContainer($container, $loader);

        $loader->load(__DIR__.'/../Fixtures/*.yaml', 'glob');
    }
}
