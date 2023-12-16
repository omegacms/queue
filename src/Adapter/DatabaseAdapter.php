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
use function serialize;
use Closure;
use Exception;
use Opis\Closure\SerializableClosure;
use Omega\Queue\Job;

/**
 * Database adapter class.
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
class DatabaseAdapter extends AbstractQueueAdapter
{
    /**
     * Push
     * @param  Closure $closure
     * @param          ...$params
     * @return int
     * @throws Exception
     */
    public function push( Closure $closure, ...$params ) : int
    {
        $wrapper = new SerializableClosure( $closure );
        $job = new Job();
        $job->closure = serialize( $wrapper );
        $job->params = serialize( $params );
        $job->attempts = 0;
        $job->save();
        return $job->id;
    }

    /**
     * Shift.
     *
     * @return ?Job
     */
    public function shift() : ?Job
    {
        $attempts = config( 'queue.database.attempts' );
        return Job::where( 'attempts', '<', $attempts )
            ->where( 'is_complete', false )
            ->first();
    }
}