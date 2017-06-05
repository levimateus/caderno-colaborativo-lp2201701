<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewMessage
 *
 * @author Jane Asher
 */
class MessageHelper {

    public static function displayAlert() {
        if (Session::has('message')) {
//            list($type, $message) = explode('|', Session::get('message'));

            $type = key( Session::get('message'));
            $message = Session::get('message')[$type];
            
            $type = ($type == 'error') ? 'error' : 'info';

            return sprintf('<div class="alert alert-%s">%s</div>', $type, $message);
        }

        return '';
    }
}
