<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace service;

use util\Service;

/**
 * Permission
 *
 * @package service
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2019/1/4
 */
class Permission extends Service {

    protected function add() {
        $post = $this->form('post');

        //验证规则是否存在
        $row = \model\Permission::find('module=? and name=?',[
            $post['module'],$post['name']
        ]);

        if($row->have) {
            $this->code = 500;
            $this->msg = '权限已存在';
            return false;
        }

        $this->data = \model\Permission::insert($post);

        return true;
    }

    protected function edit() {

    }

}