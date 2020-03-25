<?php
class MainController {
    public $model;
    public $header=VIEW_DIR."/header.html";
    public $footer=VIEW_DIR."/footer.html";

    public $view_folder;

    public $class_name;
    public function __construct()
    {
        $this->class_name=get_class($this);
        $this->view_folder=VIEW_DIR."/".strtolower(preg_replace('/Controller/','',$this->class_name));

        $this->model="vadik_yraaa";
    }


    public function loadModel($file)
    {

        if(!file_exists(MODEL_DIR."/".$file.'.php'))
        {
            die("sozdaj file \MODEL_DIR/$file.php");
        }
        $model_file=MODEL_DIR."/".$file.'.php';
        require(VENDOR_DIR."/MainModel.php");
        require($model_file);
        $class=$this->upFirstLetter($file)."Model";
        $model=new $class();
        return $model;


    }



    public function render($file='index',$params=[])
    {
       if(!file_exists($this->view_folder))
       {
           die("sozdaj papky $this->view_folder");
       }
        if(!file_exists($this->view_folder."/".$file.'.php'))
        {
            die("sozdaj file $this->view_folder/$file.php");
        }
        $done_file=$this->view_folder."/".$file.'.php';

        extract($params);
        ob_start();
        require($this->header);
       // echo $this->view_folder;//$this->templatesPath;
        require($done_file);
        require($this->footer);
        return ob_get_clean();
    }
    public  function upFirstLetter($str, $encoding = 'UTF-8')
    {
        return mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding)
            . mb_substr($str, 1, null, $encoding);
    }
}


