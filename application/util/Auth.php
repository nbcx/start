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
use nb\Cookie;
use nb\Pool;
use nb\Request;
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

    /**
     * @return Auth
     */
    public static function init() {
        if($user = Pool::get(get_class())) {
            return $user;
        }

        $token = Cookie::get('_s');
        if($token) {
            return Pool::set(get_class(), self::find('token=?', $token));
        }
        return Pool::set(get_class(), new self());

    }

    protected function _can() {
        $router = Router::driver();
        $db = Role::dao()->field('p.*');
        $db->left('role_user ru','ru.role_id=role.id');
        $db->left('permission_role pr','pr.role_id=role.id');
        $db->left('permission p','p.id=pr.permission_id');
        $db->where('ru.uid=?',1);
        $db->where('p.module=? and p.rule=?',[
            $router->module?:0,
            $router->controller.'/'.$router->function
        ]);
        if($db->count()) {
            return false;
        }
        return '权限不足';
    }

    /**
     * 权限验证
     *
     * @param null $permission [module@][folder/]controller/function[#action]
     * @return bool
     */
    public function power($permission=null) {
        //系统管理员拥有所有权限
        if(!$this->administration) {
            return true;
        }

        //默认使用当前路由权限
        $permission = $permission?:$this->permission;

        //验证是否拥有此权限
        if(in_array($permission,$this->permissions)) {
            return true;
        }

        return false;
    }

    //是否为超级管理员
    protected function _administration() {
        return false;
    }

    //用户当前使用的用户组
    protected function _role() {

    }

    //用户所属的所有用户组
    protected function _roles() {

    }

    //当前的路由权限
    protected function _permission() {
        $router = Router::driver();
        $supply = Request::input('action');
        $module = $router->module;
        $folder = $router->folder;
        $permissions = ($module?"$module@":'').($folder?"$folder/":'');
        return strtolower($permissions.$router->controller.'/'.$router->function.($supply?"#$supply":''));
    }

    //当前用户的所有可用权限
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
        $permissions = $db->fetchAll();
        $temp = [];

        foreach ($permissions as $v) {
            $module = $v['module'];
            $temp[] = ($module?"$module@":'').$v['rule'];
        }
        //这里可以使用缓存
        return $temp;
    }

}