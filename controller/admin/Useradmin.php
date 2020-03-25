<?php
class UseradminController extends MainController
{
    public function index()
    {


        $params['header_title']='Главная';
        $model=$this->loadModel('territory');
        $params['users']=[];
        $res=$model->get_result('select * from users');
        $params['users']=$res;
        echo $this->render('indexadmin',$params);
    }


}