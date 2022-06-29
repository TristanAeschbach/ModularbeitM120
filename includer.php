<?php
class includer{
    public function __construct($originFile)
    {
        $dir = scandir(__DIR__);
        foreach ($dir as $each){
            if(preg_match("/.inc./", $each) && $each != $originFile){
                include_once $each;
            }
        }
    }
}