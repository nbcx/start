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

use nb\Config;
use nb\Request;

/**
 * Controller
 *
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2018/8/9
 */
class Controller extends \nb\Controller {

    use Assist;

    public function display($template='', $vars = [], $config = []) {
        $return = $this->input('__')?:'html';
        switch ($return) {
            case 'json':
                $this->jsonview();
                break;
            case 'html':
            default:
                $this->htmlview($template, $vars, $config);
                break;
        }
    }

    private function jsonview() {
        echo $this->json([
            'code'=>0,
            'data'=>$this->view->get()
        ]);
    }

    private function htmlview($template, $vars, $config) {
        $conf = Config::$o;
        //设置使用主题
        $this->view->config([
            'view_path' =>__APP__ . "template/{$conf->template}/",
            'tpl_replace_string' => [
                '_cdn_' =>'//cdn.'.$conf->root.'/',
                '_pub_' =>'/public/',
                '_theme_'=>"/theme/{$conf->theme}/"
            ],
            'layout_on'   => $conf->theme==='pjax'?:false,
            'layout_name' => 'layout',
        ]);

        if(Request::input('_pjax') || isset($_SERVER['HTTP_X_PJAX'])) {
            $this->layout(false);
        }
        $this->assign('conf',Config::$o);
        parent::display($template, $vars, $config);
    }

    /**
     * 设置布局
     * @param $name
     * @param string $replace
     */
    protected function layout($name, $replace = '') {
        $this->view->layout($name,$replace);
    }


}