<?php
$data = array(
    'validForm' => false,
    'aanhef' => array('value' => '', 'error' => ''),
    'naam' => array('value' => '', 'error' => ''),
    'email' => array('value' => '', 'error' => ''),
    'telefoon' => array('value' => '', 'error' => ''),
    'communicatievoorkeur' => array('value' => '', 'error' => ''),
    'message' => array('value' => '', 'error' => '')
  );

  $res= setupData($data,'naam','abdeu', '/^[a-zA-Z-_\']{1,60}$/');
print_r($res);

function setupData($data,$colnaam,$value,$expression){
    if(preg_match($expression, trim($value))){
      $data[$colnaam]['value']=$value;
    }else {
      $data[$colnaam]['error']=$colnaam . ' is niet correct';
    }
    return $data;
  }
  
/*
$array =
    getDataFromFile("users/users.txt");

print_r($array);
if(!array_search('abdeu@abdeu.wser', array_column($array, 'email'))==null){
    echo "gevonden";
};
*/
function getDataFromFile($fileName)
{
    $usersfile = fopen($fileName, "r");
    $fileContent = explode("\n", fread($usersfile, filesize("users/users.txt")));
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
            echo "<br> ";
            print_r($userDataArry);
            echo "<br> ";

            array_push($data, $userDataArry);
        }
    }
    return $data;
}
