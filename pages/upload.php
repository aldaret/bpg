<?php

//$pc = new PhoneCheck();
//$res = $pc->setPhoneNumber('+355 1243 24 324', 'Albania');
//
//$params = $res['message'];


//$result = array(
//    $res['status'] => $res['message']
//);

//echo $res['message'];

//$params = json_decode($res['message']);

//var_dump($res['message']);
////echo json_encode($result, true);
//exit();

//print_r($res['message']);

//$conn = new \mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);
//
//var_export($conn);
//exit();

//$mod = new PhonesModel();

//print_r($mod->getCountriesFromJson());

//var_dump($params);
//
//$pc->checkCodeByCountryName();

//var_dump($pc->getCountryNames());

//foreach ($pc->getCountryNames() as $item) {
//    echo $item;
//}


//exit();
//$mod->setPhone($params);

//var_dump($mod);

//(new PhonesModel())->setPhone($params);

//var_export($res);

//exit();

if(isset($_POST['phone_number']) && isset($_POST["phone_country"])){
    $pc = new PhoneCheck();
    $res = $pc->setPhoneNumber($_POST["phone_number"], $_POST["phone_country"]);

    $status = $res['status'];
    $message = $res['message'];

    if ($res['status'] == 'success'){
        if (0 == (new PhonesModel())->setPhone($res['message'])){
            $message = 'Phone is already exists!';
            $status = 'error';
        }else{
            $message = 'Phone successfully add!';
        }
    }

    $result = array(
        $status => $message
    );

    echo json_encode($result);
}