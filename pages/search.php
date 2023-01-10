<?php
if(isset($_POST['search'])) {
    $pm = new PhonesModel();
    $res = $pm->getPhonesByNumber($_POST['search']);

    $res = array_column($res, 'phone', 'id');

    echo "<div style='position: relative; z-index: 9999; top: 100%; left: 0; border: 1px solid lightgray; padding: 10px'>";
    foreach ($res as $id => $item) {
        echo "<div><a href='#' id='search-result' data-id='$id'>$item</a></div>";
    }
    echo "</div>";
}