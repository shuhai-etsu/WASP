<?php
/**

 * Purpose: Helper file that consists of common functions that will be used throughout the project to perform common tasks
 *
 * Notes: This file is loaded globally by the composer autoload. In order to reload the files run composer dumpautoload
 *
 * Requirement(s):
 *
 *      Document                            Section
 *      ----------------------------------------------------------------------------------------------------------------
 *
 */

/**
 * Method: countLines()
 *
 * Purpose: Returns the number of lines excluding ones with a comment or '#' in a specified txt file
 *
 * @param $file Name of the text file to count the number of lines
 * @return Number of lines in the text file excluding the lines preceded by a # sign
 */

function countLines($file)
{
    $linecount = 0;
    $handle = fopen($file, "r");
    while(!feof($handle)){
        $line = fgets($handle);
        if(strcmp(substr(trim($line),0,1),"#")!=0)
            $linecount++;
    }

    fclose($handle);
    return $linecount;
}

/**
 * Method: debugArray()
 *
 * Purpose: Prints an array in readable format
 *
 * @param $list Array that consists of one or more elements
 * @return void
 */

function debugArray($list)
{
    echo "<pre>";
    print_r($list);
    echo "</pre>";
}


/**
 * Method authorize()
 *
 * Purpose: return correct view that should be displayed to user after login
 * @todo add conditions for other roles
 * @param $user array
 * @return page user is authorized to view
 */


function authorize($user)
{
    if($user->hasRole(config('constants.role.ADMINISTRATOR')))
    {
        return redirect('home');
    }
    else if($user->hasRole(config('constants.role.STUDENT_WORKER')))
    {
        //pending users have to complete the hiring process by completing the checklist
        if($user->hasStatus(config('constants.user_status.PENDING')))
        {
            return redirect('checklist');
        }
        //active users can see the database
        elseif($user->hasStatus(config('constants.user_status.ACTIVE')))
        {
            return redirect('studentHome');
        }
    }
    else{
        return view("errors.404");
    }
}

?>