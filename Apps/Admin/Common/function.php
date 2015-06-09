<?php
function dataToFields($data){
    $fields = array();
    foreach ($data as $k=>$v) {
        $vo = array();
        $vo['name'] = $k;
        $vo['label'] = $k;
        $vo['col'] = '4';
        $vo['type'] = 'text';
        $fields[$k] = $vo;
    }
    return $fields;
}

function ipt($f ='',$value = '')
{
    $str = '<input name="'.$f['name'].'" type="'.$f['type'].'" name="'.$value.'" class="form-control">';
    return $str;
}