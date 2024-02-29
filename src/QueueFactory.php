<?php
/**
 * Part of Omega CMS -  Queue Package
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
namespace Omega\Queue;

/**
 * @use
 */
use Closure;
use Omega\Queue\Adapter\QueueAdapterInterface;
use Omega\Queue\Exceptions\QueueException;
use Omega\Container\ServiceProvider\ServiceProviderInterface;

/**
 * Queue factory class.
 *
 * The `QueueFactory` class provides a mechanism to register and bootstrap different queue drivers
 * within the Omega CMS Queue Package.
 *
 * @category    Omega
 * @package     Omega\Queue
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class QueueFactory implements ServiceProviderInterface
{
    /**
     * Driver array.
     *
     * @var array $drivers Holds an array of driver closures.
     */
    protected array $drivers;

    /**
     * @inheritdoc
     *
     * @param  string  $alias  The alias for the driver.
     * @param  Closure $driver A closure that creates an instance of the driver.
     * @return $this
     */
    public function register( string $alias, Closure $driver ) : static
    {
        $this->drivers[ $alias ] = $driver;

        return $this;
    }

    /**
     * @inheritdoc
     *
     * @param  array $config Holds the configuration array for the queue driver.
     * @return QueueAdapterInterface Return a current instance of QueueAdapterInterface.
     * @throws DriverException If the type of the queue driver is not defined or is unrecognised.
     */
    public function bootstrap( array $config ) : QueueAdapterInterface
    {
        if ( ! isset( $config[ 'type' ] ) ) {
            throw new QueueException(
                'Type is not defined.'
            );
        }

        $type = $config[ 'type' ];

        if ( isset( $this->drivers[ $type ] ) ) {
            return $this->drivers[ $type ]( $config );
        }

    throw new QueueException(
            'Unrecognised type'
        );
    }
}