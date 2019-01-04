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
 * Login
 *
 * @package controller
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2019/1/1
 */
class Login extends Administration {

    public function index() {

        \service\Role::trigger(\nb\Request::driver()->isPost,'add');

        $this->display('login');
    }

    public function out() {

    }

}