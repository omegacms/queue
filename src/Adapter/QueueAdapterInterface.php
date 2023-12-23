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
 * Queue adapter interface.
 *
 * @category    Omega
 * @package     Omega\Queue
 * @subpackege  Omega\Queue\Adapter
 * @link        https://omegacms.github.io
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.io)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
interface QueueAdapterInterface
{
    /**
     * Push
     * @param  Closure $closure
     * @param          ...$params
     * @return int
     */
    public function push( Closure $closure, ...$params ) : int;

    /**
     * Shift.
     *
     * @return ?Job
     */
    public function shift() : ?Job;
}