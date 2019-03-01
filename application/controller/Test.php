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
use model\User;
use nb\Controller;
use nb\Dao;
use nb\Model;
use util\Auth;

/**
 * Test
 *
 * @package controller
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2019/1/30
 */
class Test extends Controller {

    public function index() {
        ed(Auth::init()->permissions);
        $this->display();
    }

    public function search() {
        $this->display();
    }

    public function api($start=1) {
        $dao = new Dao('contents','cid',[
            'driver'	=> 'mysql',
            'host' 		=> 'data.nb.cx',
            'port' 		=> '3306',
            'dbname'    => 'nblog',
            'user' 		=> 'dev',
            'pass' 		=> '123456',
            'connect'   => 'false',
            'charset' 	=> 'UTF8',
            'prefix'    => 'tc_', // 数据库表前缀
        ]);
        $data = $dao->field('cid,title,created')->where('type=?','post')->limit(20,$start)->fetchAll();
        echo json_encode($data);
    }

}