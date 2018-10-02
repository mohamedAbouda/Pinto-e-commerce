<?php
function getBaseUrl($sub_domain = '' , $scheme = TRUE){
    if ($sub_domain) {
        $sub_domain = $sub_domain.'.';
    }
    $url = $sub_domain.request()->getHttpHost().request()->getBaseUrl();
    if ($scheme) {
        return request()->getScheme().'://'.$url;
    }
    return $url;
}
?>
