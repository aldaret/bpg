<?php
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