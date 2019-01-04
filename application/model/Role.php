<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace model;

use nb\Model;

/**
 * Role
 *
 * @package model
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2018/12/28
 */
class Role extends Model {


    protected function _permissions() {
        $db = self::dao()->left('permission_role pr','pr.role_id=role.id');
        $db->where('role.id=?',$this->id);
        return $db->fetchAll();
    }

    //JsonSerializable
    //public function jsonSerialize() {
    //    return $this->toArray();
    //}

}