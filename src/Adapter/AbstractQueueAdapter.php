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
namespace Omega\Queue\Adapter;

/**
 * @use
 */
use Closure;
use Omega\Queue\Job;

/**
 * Abstract queue adapter class.
 *
 * @category    Omega
 * @package     Omega\Queue
 * @subpackege  Omega\Queue\Adapter
 * @link        https://omegacms.github.com
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.com)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
abstract class AbstractQueueAdapter implements QueueAdapterInterface
{
    /**
     * Push
     * @param  Closure $closure
     * @param          ...$params
     * @return int
     */
    abstract public function push( Closure $closure, ...$params ) : int;

    /**
     * Shift.
     *
     * @return ?Job
     */
    abstract public function shift() : ?Job;
}