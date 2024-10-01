<?php
/**
 * Part of Omega CMS - Queue Package
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
namespace Omega\Queue\Factory;

/**
 * @use
 */
use Exception;
use Omega\Queue\Adapter\DatabaseQueueAdapter;
use Omega\Queue\Adapter\QueueAdapterInterface;

/**
 * Database factory class.
 *
 * The `DatabaseFactory` class is responsible for registering and creating session
 * drivers based on configurations. It acts as a factory for different session
 * drivers and provides a flexible way to connect to various session systems.
 *
 * @category    Omega
 * @package     Database
 * @subpackage  Factory
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2024 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class QueueFactory
{
    /**
     * @inheritdoc
     * 
     * @param ?array $config Holds an optional configuration array that may be used to influence the creation of the object. If no configuration is provided, default settings may be applied.
     * @return mixed Return the created object or value. The return type is flexible, allowing for any type to be returned, depending on the implementation.
     */
    public function create( ?array $config = null ) : QueueAdapterInterface
    {
        if ( ! isset( $config[ 'type' ] ) ) {
            throw new Exception(
                'Type is not defined.'
            );
        }

        return match( $config[ 'type' ] ) {
            'database'  => new DatabaseQueueAdapter( $config ),
            default     => throw new Exception( 'Unrecognised type.' )
        };
    }    
}
