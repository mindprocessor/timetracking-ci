<?php


function alert($type, $msg){
    $html = "
        <div class='alert alert-{$type} alert-dismissible fade show' role='alert'>
        {$msg}
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
    ";
    return $html;
}


function error_tag($str){
    $html = "<small class='text-danger'><em>{$str}</em></small>";
    return $html;
}


function current_user(){
    $uid = session()->get('uid');
    $model_users = new \Track\Models\Users();
    $user = $model_users->asObject()->where('id', $uid)->first();
    return $user;
}


function current_datetime(){
    $datetime = date('Y-m-d H:i:s');
    return $datetime;
}

/**if null, it generate random hash */
function gen_hash($data=null){
    $hashed = null;
    if($data == null){
        $hashed = hash('sha256', uniqid());
    }else{
        $hashed = hash('sha256', $data);
    }
    return $hashed;
}


/**severity choices */
function severity_choices(){
    return ['low', 'medium', 'high'];
}