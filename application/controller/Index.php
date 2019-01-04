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
 * Index
 *
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2018/8/9
 */
class Index extends Administration {

    public function index() {
        $this->assign('hello','123');
        $this->display('index');
    }

    public function test() {
        $this->display('test');
    }

    public function test2() {
        $this->display('test2');
    }

    public function map() {
        $this->assign('ak','DD205ad29d809f6a8cc23d82189745fa');
        $this->display('map');
    }

    public function map2() {
        $this->assign('ak','DD205ad29d809f6a8cc23d82189745fa');
        $this->display('map2');
    }
}