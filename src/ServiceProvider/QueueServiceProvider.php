<?php
/**
 * Part of Banco Omega CMS -  Queue Package
 *
 * @link       https://omegacms.github.io
 * @author     Adriano Giovannini <omegacms@outlook.com>
 * @copyright  Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license    https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 */

/**
 * @declare
 */
declare( strict_types = 1 );

/**
 * @namespace
 */
namespace Omega\Queue\ServiceProvider;

/**
 * @use
 */
use Omega\Queue\QueueFactory;
use Omega\Queue\Adapter\DatabaseAdapter;
use Omega\ServiceProvider\AbstractServiceProvider;
use Omega\ServiceProvider\ServiceProviderInterface;

/**
 * Queue service provider class.
 *
 * @category    Omega
 * @package     Omega\Queue
 * @subpackege  Omega\Queue\ServiceProvider
 * @link        https://omegacms.github.com
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.com)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class QueueServiceProvider extends AbstractServiceProvider
{
    /**
     * Get the service name.
     *
     * @return string Return the service name.
     */
    protected function name() : string
    {
        return 'queue';
    }

    /**
     * Get the service factory.
     *
     * @return mixed
     */
    protected function factory() : ServiceProviderInterface
    {
        return new QueueFactory();
    }

    /**
     * Get drivers.
     *
     * @return array Return an array of drivers for the service.
     */
    protected function drivers() : array
    {
        return [
            'database' => function( $config ) {
            return new DatabaseAdapter( $config );
            },
        ];
    }
}
