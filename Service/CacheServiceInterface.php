<?php
/**
 * apollon
 *
 * Copyright (c) 2012-2013, Trivago GmbH
 * All rights reserved.
 *
 * @since 21.01.14
 * @author Innovation Center Leipzig <team.leipzig@trivago.com>
 * @author Roman Lasinski <roman.lasinski@trivago.com>
 * @copyright 2012-2013 Trivago GmbH
 */
namespace Tedivm\StashBundle\Service;

use Stash\Interfaces\PoolInterface;

/**
 * Class CacheServiceInterface
 *
 * @package Tedivm\StashBundle\Service
 * @author Innovation Center Leipzig <team.leipzig@trivago.com>
 * @author Roman Lasinski <roman.lasinski@trivago.com>
 * @copyright 2012-2013 Trivago GmbH
 */
interface CacheServiceInterface extends PoolInterface
{
    /**
     * @return CacheLogger
     */
    public function getQueryLogger();
} 