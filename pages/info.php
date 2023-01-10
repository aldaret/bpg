<?php
if(isset($_POST['phone_number_search'])){
    $pm = new PhonesModel();
    $res = $pm->getPhoneInfoByPhone($_POST['phone_number_search']);

    if (0 != $res){
        $message = [
            'phone' => $res['phone'],
            'country_code' => $res['country_code'],
            'country_name' => $res['country_name']
        ];
        $status = 'success';
    }else{
        $message = 'Phone is not exist!';
        $status = 'error';
    }

    $result = array(
        $status => $message
    );

    echo json_encode($result);
}