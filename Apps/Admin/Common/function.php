<?php
function dataToFields($data){
    $fields = array();
    foreach ($data as $k=>$v) {
        $vo = array();
        $vo['name'] = $k;
        $vo['label'] = $k;
        $vo['col'] = '4';
        $vo['type'] = 'text';
        $vo['showList'] = 1;
        $vo['showAdd'] = 1;
        $vo['showEdit'] = 1;
        $fields[$k] = $vo;
    }
    return $fields;
}

function ipt($f ='',$value = '')
{
    if ($f['type'] == 'editor') {
        $str = '<div id="'.$f['name'].'" data-editor >'.$value.'</div>';
    }else{
        $str = '<input name="'.$f['name'].'" type="'.$f['type'].'" value="'.$value.'" class="form-control">';
    }
    return $str;
}