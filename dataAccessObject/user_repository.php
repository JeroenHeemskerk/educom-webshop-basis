<?php


function saveUser($user, $filename = "./dataAccessObject/users/users.txt")
{
    $newUser = array($user['email'], $user['naam'], $user['wachtwoord']);
    $fileInput = implode("|", $newUser);
    $usersfile = fopen($filename, "a");
    fwrite($usersfile, "\n");
    fwrite($usersfile, $fileInput);
    fclose($usersfile);
}



function findUserByEmail($email,$filename = "./dataAccessObject/users/users.txt")
{
    $users = upLoadDataFromFile($filename);
    for ($i = 0; $i < sizeof($users); $i++) {
        if (strcmp($users[$i]['email'], $email)==0) {
          return $users[$i] ;
        }
      }
      return null;
}


/***************************************************************
 * deze function returnert 
 * [col1] | [col2] | [col3] .......
 *  val1  |  val2  |  val3 
 * array(
 * [col1] => val1,
 * [col2] => val2,
 * [col3] => val3
 * ............
 * ) 
 ***************************************************************/
function upLoadDataFromFile($filename)
{
    $usersfile = fopen($filename, "r");
    $fileContent = explode("\n", fread($usersfile, filesize($filename)));
    fclose($usersfile);
    $data = array();
    if (sizeof($fileContent) > 1) {
        $ColName = explode('|', $fileContent[0]);

        $ColName = array_map(function ($col) {
            preg_match("/\\[(.*?)\\]/", $col, $res);

            return  $res[1];
        }, $ColName);
        for ($lineNum = 1; $lineNum < sizeof($fileContent); $lineNum++) {
            $userDataString = explode('|', $fileContent[$lineNum]);
            $userDataArry = array();
            for ($col = 0; $col < sizeof($userDataString); $col++) {
                $userDataArry += [$ColName[$col] => $userDataString[$col]];
            }

            array_push($data, $userDataArry);
        }
    }
    return $data;
}
