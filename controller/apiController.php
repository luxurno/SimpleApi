<?php

/*
 * @Author: Marcin Szostak
 * @Date: 08-13-2017
 * @Title: Code review
 * @Description: Simple API
 */

class apiController extends controller
{
    public function __construct($method, $id)
    {
        if(is_integer($id))
        {
            $apiModel = new apiModel($id);
            switch($method)
            {
                case 'create':
                    $apiModel->create($id);
                    break;
                case 'read':
                    $apiModel->read($id);
                    break;
                case 'readAll':
                    $apiModel->readAll();
                    break;
                case 'update':
                    $apiModel->update($id);
                    break;
                case 'delete':
                    $apiModel->delete($id);
                    break;
                default:
                    $error = new errorView();
                    break;
            }
        }
        else
        {
            $this->getView('error');
        }
    }
}
