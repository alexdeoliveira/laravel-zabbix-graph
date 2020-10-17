<?php

namespace Alexdeoliveira\LaravelZabbixGraph;

use Illuminate\Support\Facades\Facade;
use Alexdeoliveira\ZabbixGraph\ZabbixGraph;

/**
 * @see \Alexdeoliveira\ZabbixGraph\ZabbixGraph
 */
class ZabbixGraphFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ZabbixGraph::class;
    }
}
