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
namespace Omega\Queue;

/**
 * @use
 */
use Closure;
use Omega\Queue\Adapter\QueueAdapterInterface;
use Omega\Queue\Exceptions\DriverException;
use Omega\ServiceProvider\ServiceProviderInterface;

/**
 * Queue factory class.
 *
 * @category    Omega
 * @package     Omega\Queue
 * @link        https://omegacms.github.com
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.com)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class QueueFactory implements ServiceProviderInterface
{
    /**
     * Driver array.
     *
     * @var array $drivers Holds an array of driver.
     */
    protected array $drivers;

    /**
     * Add driver.
     *
     * @param  string  $alias  Holds the driver alias.
     * @param  Closure $driver Holds an instance of Closure.
     * @return $this
     */
    public function register( string $alias, Closure $driver ) : static
    {
        $this->drivers[ $alias ] = $driver;

        return $this;
    }

    /**
     * Connect the driver.
     *
     * @param  array $config Holds an array of configuration.
     * @return mixed
     */
    public function bootstrap( array $config ) : QueueAdapterInterface
    {
        if ( ! isset( $config[ 'type' ] ) ) {
            throw new DriverException(
                'Type is not defined.'
            );
        }

        $type = $config[ 'type' ];

        if ( isset( $this->drivers[ $type ] ) ) {
            return $this->drivers[ $type ]( $config );
        }

        throw new DriverException(
            'Unrecognised type'
        );
    }
}