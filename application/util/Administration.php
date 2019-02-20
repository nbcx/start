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

use nb\Router;

/**
 * Administration
 *
 * @package util
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2018/12/27
 */
class Administration extends Controller {

    public function __before() {
        $auth = Auth::init();

        //检查是否登录
        if($auth->empty) {
            redirect('/login');
            return false;
        }

        if(!$auth->power()) {
            $this->tips('无权限执行此操作！');
        }
        $this->assign('auth',$auth);
        return true;
    }

    /**
     * 通用的视图展示控制器
     * 当视图不需要特定数据，可以直接使用此方法展示
     *
     * @param $action 视图名称
     */
    public function tpl($action){
        $this->display(Router::driver()->controller.'/'.$action);
    }



}