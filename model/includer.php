<?php
class includer{
    public function __construct($originFile)
    {
        $DIRNAME = pathinfo($originFile, PATHINFO_DIRNAME);
        if (preg_match("/controller/", $DIRNAME)){
            $controller = __DIR__;
            $model = "../model";
            $view = "../view";
        }
        if (preg_match("/model/", $DIRNAME)){
            $controller = "../controller";
            $model = __DIR__;
            $view = "../view";
        }
        if (preg_match("/view/", $DIRNAME)){
            $controller = "../controller";
            $model = "../model";
            $view = __DIR__;
        }
        $controller = scandir($controller);
        $model = scandir($model);
        $view = scandir($view);

        print_r($model);

        foreach ($controller as $each){
            if(preg_match("/.inc./", $each) && $each != $originFile){
                include $each;
                echo "included ".$each;
            }
        }
        foreach ($model as $each){
            if(preg_match("/.inc./", $each) && $each != $originFile){
                include $each;
                echo "included ".$each;
            }
        }
        foreach ($view as $each){
            if(preg_match("/.inc./", $each) && $each != $originFile){
                include $each;
                echo "included ".$each;
            }
        }
    }
}