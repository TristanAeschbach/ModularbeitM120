<?php

class reroute
{
    public function __construct($url)
    {
        echo "<meta http-equiv='refresh' content='0;url=$url'>";
    }
}