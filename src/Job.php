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
use function config;
use function unserialize;
use Omega\Model\AbstractModel;

/**
 * Job class.
 *
 * @category    Omega
 * @package     Omega\Queue
 * @link        https://omegacms.github.com
 * @author      Adriano Giovannini <omegacms@outlook.com>
 * @copyright   Copyright (c) 2022 Adriano Giovannini. (https://omegacms.github.com)
 * @license     https://www.gnu.org/licenses/gpl-3.0-standalone.html     GPL V3.0+
 * @version     1.0.0
 */
class Job extends AbstractModel
{
    /**
     * Closure object.
     *
     * @var mixed $closure Holds the closure object.
     */
    private mixed $closure;

    /**
     * Params.
     *
     * @var mixed $params Holds the params.
     */
    private mixed $params;

    /**
     * Get database table.
     *
     * @return string Return the database table.
     */
    public function getTable() : string
    {
        return config( 'queue.database.table' );
    }

    /**
     * Run the job.
     *
     * @return mixed
     */
    public function run() : mixed
    {
        $closure = unserialize( $this->closure );
        $params  = unserialize( $this->params );

        return $closure( ...$params );
    }
}