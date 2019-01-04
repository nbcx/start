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

use model\Role;
use model\User;
use nb\Pool;
use nb\Router;

/**
 * Auth
 *
 * @package util
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2018/12/27
 */
class Auth extends User {

    public static function init() {
        if($user = Pool::get(get_class())) {
            return $user;
        }
        return Pool::set(get_class(),new Auth([]));
    }

    public static function check($name,$module=null) {

    }

    protected function _can() {
        $router = Router::driver();
        $db = Role::dao()->field('p.*');
        $db->left('role_user ru','ru.role_id=role.id');
        $db->left('permission_role pr','pr.role_id=role.id');
        $db->left('permission p','p.id=pr.permission_id');
        $db->where('ru.uid=?',1);
        $db->where('p.module=? and p.name=?',[
            $router->module?:0,
            $router->controller.'/'.$router->function
        ]);
        if($db->count()) {
            return false;
        }
        return '权限不足';
    }

    protected function _role() {

    }

    protected function _permissions() {
        /*
        $db = User::dao()->field('p.*');
        $db->left('role_user ru','ru.uid=user.id');
        $db->left('role r','r.id=ru.role_id');
        $db->left('permission_role pr','pr.role_id=r.id');
        $db->left('permission p','p.id=pr.permission_id');
        $db->where('user.id=?',1);
        return $db->fetchAll();
        */

        $db = Role::dao()->field('p.*');
        $db->left('role_user ru','ru.role_id=role.id');
        $db->left('permission_role pr','pr.role_id=role.id');
        $db->left('permission p','p.id=pr.permission_id');
        $db->where('ru.uid=?',1);
        return $db->fetchAll();
    }

}