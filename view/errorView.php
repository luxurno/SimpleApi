<?php

/*
 * @Author: Marcin Szostak
 * @Date: 08-13-2017
 * @Title: Code review
 * @Description: Simple API
 */

class errorView extends view
{
    public function __construct() {
        $this->render('error');
    }
}
