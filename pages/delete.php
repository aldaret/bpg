<?php
if(isset($_POST['phone_id_del'])){
    $pm = new PhonesModel();
    $res = $pm->deletePhoneById($_POST['phone_id_del']);

    if ($res){
        $message = 'Phone is delete!';
        $status = 'success';
    }else{
        $message = 'Phone is not delete!';
        $status = 'error';
    }

    $result = array(
        $status => $message
    );

    echo json_encode($result);
}