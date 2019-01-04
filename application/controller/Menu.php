<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace controller;

use util\Administration;

/**
 * Menu
 *
 * @package controller
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2019/1/2
 */
class Menu extends Administration {

    public function index() {
        $this->display();
    }

    public function add() {
        $this->display();
    }
}