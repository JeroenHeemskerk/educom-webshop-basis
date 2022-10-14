
<?php
include("./dataAccessObject/user_repository.php");
function validateContact()
{
    $data = array(
        'validForm' => false,
        'aanhef' => array('value' => '', 'error' => ''),
        'naam' => array('value' => '', 'error' => ''),
        'email' => array('value' => '', 'error' => ''),
        'telefoon' => array('value' => '', 'error' => ''),
        'communicatievoorkeur' => array('value' => '', 'error' => ''),
        'message' => array('value' => '', 'error' => '')
    );
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data['validForm'] = true;
        $data = setupData($data, 'aanhef', $_POST['aanhef'], '/^dhr$|^mvr$/');
        $data = setupData($data, 'naam', $_POST['naam'], '/^[a-zA-Z-_\']{1,60}$/');
        $data = setupData($data, 'email', $_POST['email'], '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/');
        $data = setupData($data, 'telefoon', $_POST['telefoon'], '/^0[1-9][0-9]{8}$|^\+[1-9][0-9][1-9][0-9]{8}$/');
        $data = setupData($data, 'message', $_POST['bericht'], '/.{2,1000}/');
        $data = setupData($data, 'communicatievoorkeur', $_POST['communicatievoorkeur'], '/^email$|^Telefoon$/');
    }
    return $data;
}


function setupData($data, $colnaam, $value = '', $expression)
{
    if (preg_match($expression, trim($value))) {
        $data[$colnaam]['value'] = $value;
    } else {
        $data['validForm'] = false;
        $data[$colnaam]['error'] = $colnaam . ' is niet correct';
        $data[$colnaam]['value'] = $value;
    }
    return $data;
}






function validateRegister()
{
    $data = array(
        'validForm' => false,
        'naam' => array('value' => '', 'error' => ''),
        'email' => array('value' => '', 'error' => ''),
        'wachtwoord' => array('value' => '', 'error' => ''),
        'herhaaldWachtwoord' => array('value' => '', 'error' => '')
    );
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data['validForm'] = true;
        $data = setupData($data, 'naam', $_POST['naam'], '/^[a-zA-Z-_\']{1,60}$/');
        $data = setupData($data, 'email', $_POST['email'], '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/');
        $data = setupData($data, 'wachtwoord', $_POST['wachtwoord'], '/.{2,100}/');
        $data = setupData($data, 'herhaaldWachtwoord', $_POST['herhaaldWachtwoord'], '/' . $_POST['wachtwoord'] . '$/');
    }
    if (!$data['validForm']) {
        return $data;
    } else {
        if (findUserByEmail($data['email']['value']) != null) {
            $data['email']['error'] = 'try other email';
            $data['validForm'] = false;
        } else {
            $user = array('naam' => $data['naam']['value'], 'email' => $data['email']['value'], 'wachtwoord' => $data['wachtwoord']['value']);
            saveUser($user);
            $data['validForm'] = true;
        }
    }
    return $data;
}

function validateLogin()
{
    $data = array(
        'validForm' => false,
        'email' => array('value' => '', 'error' => ''),
        'wachtwoord' => array('value' => '', 'error' => ''),

    );

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data['validForm'] = true;
        $data = setupData($data, 'email', $_POST['email'], '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/');
        $data = setupData($data, 'wachtwoord', $_POST['wachtwoord'], '/.{2,100}/');
    }
    if($data['validForm']){
        $user=findUserByEmail($data['email']['value']);
        if($user!=null&&strcmp($_POST['wachtwoord'],$user['wachtwoord'])==0){
             user_login($user);
        }else {
            $data['email']['error']= 'inlog gegevens niet valid';
            $data['validForm'] = false;
        }

    }
    return $data;
    
}
