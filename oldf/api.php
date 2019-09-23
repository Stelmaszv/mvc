<?php
    use IVO\apiIVO;
    use Api\ajaxusers;
    apiIVO::register('ajaxusers', function () {
       return ajaxusers::create();
    });
    if(isset($_GET['api'])) {
        $api = apiIVO::resolve($_GET['api']);
        $api->show();
    }
?>