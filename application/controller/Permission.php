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
 * Permission
 *
 * @package controller
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2019/1/2
 */
class Permission extends Administration {

    public function index() {
        $permissions = \model\Permission::fetchs();
        $this->assign('permissions',$permissions);
        $this->display();
    }

    public function add() {
        \service\Permission::trigger($this->isPost,'add');
        $this->display();
    }

    public function reorder() {
        \service\Permission::trigger($this->isPost,'reorder');
        $this->display();
    }

}