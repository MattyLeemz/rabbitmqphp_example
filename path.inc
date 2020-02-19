<?php
$path = '/usr/local/lib/system_libs'; //path is initialized
    if (file_exists('local.ini'))   //the file local.ini exists run code
    {
	    $parse = parse_ini_file('local.ini',true);  //parse is set to load the file local.ini, true makes it as an array

        if (isset($parse['paths'])) //if parse contains something in it (not null) 
        {
            $path = $parse['paths']['libraries'];
        }
        else
        {
           trigger_error("local.ini missing paths field\n",E_USER_NOTICE); 
        }
    }
    set_include_path(get_include_path().PATH_SEPARATOR.$path);
?> 
