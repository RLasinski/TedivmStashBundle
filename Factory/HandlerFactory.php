<?php
namespace Tedivm\StashBundle\Factory;

use Stash\Drivers,
    Stash\Interfaces\DriverInterface;

class HandlerFactory {

    /**
     * Given a list of cache types and options, creates a CompositeDrivers wrapping the specified drivers.
     *
     * @param $types
     * @param $options
     * @return DriverInterface
     */
    static function createHandler($types, $options)
    {
        $availableDrivers = Drivers::getDrivers();

        $compositeHandlers = array();

        foreach ($types as $type) {
            $class = $availableDrivers[$type];
            if ($type === 'Memcache' && isset($options[$type])) {
                // Fix servers spec since underlying drivers expect plain arrays, not hashes.
                $servers = array();
                foreach ($options[$type]['servers'] as $serverSpec) {
                    $servers[] = array(
                        $serverSpec['server'],
                        $serverSpec['port'],
                        isset($serverSpec['weight']) ? $serverSpec['weight'] : null
                    );
                }

                $options[$type]['servers'] = $servers;
            }

            $opts = isset($options[$type]) ? $options[$type] : array();
            try {
                $compositeHandlers[] = new $class($opts);
            } catch (\Exception $e) {
            }
        }

        if (count($compositeHandlers) == 1) {
            return reset($compositeHandlers);

        } elseif (count($compositeHandlers) === 0) {
            $class = $availableDrivers['BlackHole'];
            return new $class();
        }

        $class = $availableDrivers['Composite'];
        $handler = new $class(array('drivers' => $compositeHandlers));

        return $handler;
    }
}
