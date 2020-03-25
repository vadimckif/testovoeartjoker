<?php
class UserController extends MainController
{
    public function register()
    {
        session_start();
        if(isset($_SESSION['error']))
        {
            $arr_isset=[];
            $user=$_SESSION['error'][0];

            $params['error']=$user;
            unset($_SESSION['error']);
        }
        if(isset($_SESSION['success']))
        {
            $params['success']=$_SESSION['success'];
            unset($_SESSION['success']);
        }
        $params['header_title']="Регистрация";
         $model_territory=$this->loadModel('territory');
         $params['zones']=$model_territory->get_result('select * from t_koatuu_tree where ter_level=1 ');
        echo $this->render('register',$params);
    }
    public function calculate()
    {
        if(!$_POST)
        {
         return false;
        }
        session_start();
        $referer=$_SERVER['HTTP_REFERER'];
        $name=$_POST['fio'];
        $email=$_POST['email'];
        $zone=$_POST['zone'];
        $city=$_POST['city'];
        $rajen=$_POST['rajen'];
        $model_territory= $this->loadModel('territory');
        $res=$model_territory->get_result("select * from users where email= '".$email."'");
        if($res)
        {
            //die();
            $_SESSION['error']=$res;
            header("Location: $referer");
            die();
        }

        $_zone=$model_territory->get_result("select * from t_koatuu_tree where ter_id='".$zone."'")[0]->ter_name;
        $_city=$model_territory->get_result("select * from t_koatuu_tree where ter_id='".$city."'")[0]->ter_name;
        $_rajen=$model_territory->get_result("select * from t_koatuu_tree where ter_id='".$rajen."'")[0]->ter_name;

        $territory=" Область:".$_zone.",город: ".$_city.",район:".$_rajen;

       $id=$model_territory->insert("INSERT INTO users (name,email,territory) VALUES ('".$name."', '".$email."', '".$territory."')");
          if($id)
          {
              $id_t_u=$model_territory->insert("INSERT INTO territory_users (user_id,zone,city,rajen) VALUES ('".$id."', '".$zone."', '".$city."', '".$rajen."')");


          }
        $_SESSION['success']="Вы удачно добавили пользователя";
        header("Location: $referer");
    }
    public function getcity()
    {
        if(isset($_GET['zone']))
        {
           $zone=$_GET['zone'];
           $model_territory=$this->loadModel('territory');
           $cities=$model_territory->get_result('select * from t_koatuu_tree where ter_type_id=1 and ter_level=2 and ter_pid='.$zone.'');
           //debug($cities);
            echo json_encode($cities);
        }
    }
    public function getrajen()
    {
        if(isset($_GET['city']))
        {
            $city=$_GET['city'];
            $model_territory=$this->loadModel('territory');
            $rajens=$model_territory->get_result('select * from t_koatuu_tree where ter_level=3 and ter_pid='.$city.'');
            //debug($cities);
            echo json_encode($rajens);
        }
    }
}