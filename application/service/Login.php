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

use nb\Cookie;
use util\Service;

/**
 * Login
 *
 * @package service
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2019/1/2
 */
class Login extends Service {

    public function in() {
        list($name,$pass) = $this->input('post',[
            'name','pass'
        ]);
        $user = \util\Auth::find('name=?',$name);
        if($user->empty) {
            $this->msg = '用户不存在';
            return false;
        }
        if($user['pass'] !== md5($pass)) {
            $this->msg = '密码错误';
            return false;
        }
        $token = md5($user->id.time());
        \util\Auth::updateId($user->id,[
            'token'=>$token
        ]);
        Cookie::set('_s',$token);
        $this->data = $token;
        return true;
    }

    public function out() {

    }

}