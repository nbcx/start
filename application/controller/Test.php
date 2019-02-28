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
use model\User;
use nb\Controller;
use util\Auth;

/**
 * Test
 *
 * @package controller
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2019/1/30
 */
class Test extends Controller {

    public function index() {
        ed(Auth::init()->permissions);
        $this->display();
    }

    public function search() {
        $this->display();
    }

    public function api() {
        //$us = User::findId(1);
        $us = User::fetchs();
        echo json_encode($us);
    }

}