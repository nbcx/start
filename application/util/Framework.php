<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace util;

use model\Domain;
use nb\Cache;
use nb\event\Framework as Frame;
use nb\Pool;
use nb\Request;

/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 17/12/2 下午4:46
 */
class Framework extends Frame {

    public function error($e,$deadly = false) {
        return true;
        echo $e->getFile().':'.$e->getLine()."\n";
        echo $e->getMessage()."\n";
        return false;
    }

    public function notfound() {
        return parent::notfound(); // TODO: Change the autogenerated stub
    }

}