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
 * Role
 *
 * @package controller
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2018/12/27
 */
class Role extends Administration {

    public function index() {
        $roles = \model\Role::fetchs();
        $this->assign('roles',$roles);
        $this->display();
    }

    public function add() {
        \service\Role::trigger($this->isPost,'add');

        $this->display();
    }

    public function edit() {
        \service\Role::trigger($this->isPost,'edit');
        $this->display();
    }

    public function del() {
        \service\Role::run('del');
    }


}