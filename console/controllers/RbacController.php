<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller {
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $createPost = $auth->createPermission('addUser');
        $createPost->description = 'Registration user';
        $auth->add($createPost);

        $createPost = $auth->createPermission('updateUser');
        $createPost->description = 'Update user';
        $auth->add($createPost);

        $createPost = $auth->createPermission('deleteUser');
        $createPost->description = 'Delete user';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);

        $auth->assign($admin, 1);
    }
} 