
<?php
include("./dataAccessObject/user_repository.php");
function validateContact()
{
    

    
    $data = array( 
        'validForm' => false, 
        'formFields' => array('aanhef', 'naam', 'email', 'telefoon', 'communicatievoorkeur', 'message'),
        'aanhef' => array('value' => '', 'error' => '', 'label' => 'Aanhef:', 'type' => 'select', 'required' => true, 'options' => array(array('value'=>'dhr' , 'content'=> 'Dhr' , 'selected'=> ''), array('value'=>'mvr' , 'content'=> 'Mvr' , 'selected'=> ''))), 
        'naam' => array('value' => '', 'error' => '', 'label' => 'Naam:', 'type' => 'text', 'regEx' => '/^[a-zA-Z-_\']{1,60}$/', 'placeholder' => 'jouw naam'), 
        'email' => array('value' => '', 'error' => '', 'label' => 'Email:', 'type' => 'email', 'regEx' => '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', 'placeholder' => 'jouw email', 'checks' => array('validEmail')), 
        'telefoon' => array('value' => '', 'error' => '', 'label' => 'Telefoon:', 'type' => 'text', 'regEx' => '/^0[1-9][0-9]{8}$|^\+[1-9][0-9][1-9][0-9]{8}$/', 'placeholder' => 'jouw telefoon'), 
        'communicatievoorkeur' => array('value' => '', 'error' => '', 'label' => 'wat is jouw communicatievoorkeur?', 'type' => 'radio', 'required' => true, 'options' => array('email' => 'Email', 'telefoon' => 'Telefoon')), 
        'message' => array('value' => '', 'error' => '', 'label' => 'Laat ons weten waarover je contact wil opnemen.', 'type' => 'textarea', 'regEx' => '/^.{2,1000}$/', 'rows' => 4, 'cols'=>50) 
      );

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data['validForm'] = true;
        $data = setupData($data, 'aanhef', $_POST['aanhef'], '/^dhr$|^mvr$/');
        $data = setupData($data, 'naam', $_POST['naam'], '/^[a-zA-Z-_\']{1,60}$/');
        $data = setupData($data, 'email', $_POST['email'], '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/');
        $data = setupData($data, 'telefoon', $_POST['telefoon'], '/^0[1-9][0-9]{8}$|^\+[1-9][0-9][1-9][0-9]{8}$/');
        $data = setupData($data, 'message', $_POST['bericht'], '/.{2,1000}/');
        $data = setupData($data, 'communicatievoorkeur', isset($_POST['communicatievoorkeur']) ? $_POST['communicatievoorkeur'] : null, '/^email$|^telefoon$/');
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
        'naam' => array('value' => '', 'error' => '','htmlElem' => 'input', 'type'=>'text','label' => 'jouw naam'),
        'email' => array('value' => '', 'error' => '','htmlElem' => 'input', 'type'=>'email','label' => 'jouw email'),
        'wachtwoord' => array('value' => '', 'error' => '','htmlElem' => 'input', 'type'=>'password','label' => 'jouw wachtwoord'),
        'herhaaldWachtwoord' => array('value' => '', 'error' => '','htmlElem' => 'input', 'type'=>'password','label' => 'Herhaal jouw wachtwoord')
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
        'formFields' =>array('email' ,'wachtwoord'),
        'email' => array('value' => '', 'error' => '', 'type'=> 'email' , 'label'=>'vul jouw email in'),
        'wachtwoord' => array('value' => '', 'error' => '','type'=> 'password' , 'label'=>'vul jouw wachtwoord in'),

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
