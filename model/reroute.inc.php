<?php

class reroute
{
    public function __construct($url)
    {
        if (is_file("view/$url")){
            $url = "view/$url";
        }elseif (is_file("model/$url")){
            $url = "model/$url";
        }else{
            $url = "controller/$url";
        }
        echo "<meta http-equiv='refresh' content='0;url=$url'>";
    }
}