<?php
/**
 * Part of Omega CMS -  Queue Package
 *
 * @link       https://omegacms.github.io
 * @author     Adriano Giovannini <omegacms@outlook.com>
 * @copyright  Copyright (c) 2024 Adriano Giovannini. (https://omegacms.github.io)
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
use Closure;
use Omega\Queue\QueueFactory;
use Omega\Queue\Adapter\DatabaseQueueAdapter;
use Omega\Container\ServiceProvider\AbstractServiceProvider;
use Omega\Container\ServiceProvider\ServiceProviderInterface;

/**
 * Queue service provider class.
 *
 * The `QueueServiceProvider` class is responsible for providing the QueueFactory
 * and registering the database queue driver within the Omega CMS Queue Package.
 *
 * @category    Omega
 * @package     Omega\Queue
 * @subpackege  Omega\Queue\ServiceProvider
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2024 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class QueueServiceProvider extends AbstractServiceProvider
{
    /**
     * @inheritdoc
     *
     * @return string Return the service name.
     */
    protected function name() : string
    {
        return 'queue';
    }

    /**
     * @inheritdoc
     *
     * @return ServiceProviderInterface Return an instance of ServiceProviderInterface.
     */
    protected function factory() : ServiceProviderInterface
    {
        return new QueueFactory();
    }

    /**
     * @inheritdoc
     *
     * @return array<string, Closure> Return an array of closures that create instances of queue drivers.
     */
    protected function drivers() : array
    {
        return [
            'database' => function( $config ) {
            return new DatabaseQueueAdapter( $config );
            },
        ];
    }
}
