<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Demo;
use yii\web\UploadedFile;
use frontend\models\UploadForm;
use yii\data\Pagination;//分页类

class StudentController extends Controller{

    public function init()
    {
        $session = Yii::$app->session;
        $user = $session->get('user_info');
        if(empty($user))
        {
            return $this->redirect(['/member/login']);
        }
    }

    public function actionIndex()
    {
        $model = new Demo();
        $response = $model->find();
        if($keywords = Yii::$app->request->get('username'))
        {
            $response->where(['like','username',$keywords]);
        }
        $pagination = new Pagination([
            'defaultPageSize'=>2,//每页显示的条数
            'totalCount'=>$response->count()//获取数据总条数
        ]);
        $list = $response
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->asArray()
            ->all();
        return $this->render('index',[
            'list'=>$list,
            'pagination'=>$pagination,
        ]);
    }

    public function actionDel()
    {
        $model = new Demo();
        $id = Yii::$app->request->get('id');
        //$res = $model->findOne($id)->delete();
        $res = $model->deleteAll('id=:id',[':id'=>$id]);
        if($res)
        {
            return $this->redirect(['demo/index']);
        }
    }

    public function actionSave()
    {
        $model = new Demo();//实例化model
        //载入表单提交的数据 并进行验证
        if($model->load(Yii::$app->request->post()) && $model->validate())
        {
            //验证成功并载入model
            //判断当前是新增还是修改
            if($id = Yii::$app->request->get('id'))
            {
                //修改
                $model = $model->findOne($id);//查询当前数据
                $post = Yii::$app->request->post('Student');//接收表单数据
                //对model进行重新赋值
                $model->username = $post['username'];
                $model->sex = $post['sex'];
                $model->age = $post['age'];
                $model->email = $post['email'];
                $model->tel = $post['tel'];
                $model->card = $post['card'];
                $model->name = $post['name'];
                $model->hobby =implode(',',$post['hobby']);//将数组变为字符串
            }else
            {
                //新增
                $model->hobby = implode(',',$model->hobby);//将数组变为字符串
            }
            $res = $model->save();//执行新增或者修改
            if($res)
            {
                return $this->redirect(['demo/index']);
            }
        }else
        {
            //判断当前是否为修改请求
            if($id = Yii::$app->request->get('id'))
            {
                $model = $model->findOne($id);//查询当前数据
                $model->hobby = explode(',',$model->hobby);//将数组变为字符串，为了实现默认选中
            }
            return $this->render('save',['model'=>$model]);
        }
    }

}



?>