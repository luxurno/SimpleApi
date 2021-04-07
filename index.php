<?php

/*
 * @Author: Marcin Szostak
 * @Date: 08-13-2017
 * @Title: Code review
 * @Description: Simple API
 */

/* Settings */
include 'config/config.php';
/* Settings */

/* Controllers */
include 'controller/controller.php';
include 'controller/apiController.php';
include 'controller/mainController.php';
/* Controllers */

/* Models */
include 'model/model.php';
include 'model/apiModel.php';
include 'model/updateData.class.php';
/* Models */

/* Views */
include 'view/view.php';
/* Views */


$app = new mainController();

?>