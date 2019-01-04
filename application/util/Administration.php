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
        return true;
        //请求权限校验
        if(Auth::init()->can) {
            ed('权限不足！');
        }

        return true;
    }



}