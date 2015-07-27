<?php
function dataToFields($data){
    $fields = array();
    foreach ($data as $k=>$v) {
        $vo = array();
        $vo['name'] = $k;
        $vo['label'] = $k;
        $vo['col'] = '4';
        $vo['type'] = 'text';
        $vo['actype'] = 'String';
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
        $str = '<div id="umeditor" name="'.$f['name'].'" >'.$value.'</div>';
    }elseif ($f['type'] == 'file') {
        $str = '<div class="input-group">
                    <input value="'.$value['id'].'" class="'.$f['name'].'_id" type="hidden" name="'.$f['name'].'[id]" />
                    <input value="'.$value['name'].'" class="'.$f['name'].'_name" type="hidden" name="'.$f['name'].'[name]" />
                    <input value="'.$value['url'].'" class="'.$f['name'].'_url" type="hidden" name="'.$f['name'].'[url]" />
					<input type="text" value="'.$value['url'].'" name="'.$f['name'].'_ipt" class="form-control" >
					<span class="input-group-btn">
					<button type="button" data-file-name="'.$f['name'].'" class="btn green btn-file-pre " >预览</button>
					</span>
                    <span class="input-group-btn">
					<button type="button" data-file-name="'.$f['name'].'" class="btn blue btn-file " >上传</button>
					</span>
				</div>';
    }else{
        $str = '<input name="'.$f['name'].'" type="'.$f['type'].'" value="'.$value.'" class="form-control">';
    }
    return $str;
}
