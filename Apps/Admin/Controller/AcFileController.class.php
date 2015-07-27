<?php
namespace Admin\Controller;
use Think\Controller;
class AcFileController extends AcController {
    public function index($curPage =1,$pageSize = 10)
    {
        if (IS_POST) {
            $m = D('ApiCloud');
            $map['class'] = 'file';
            $ret = $m->getPage($map,$curPage,(int)$pageSize);


            $data['success'] = true;
            $data['data'] = $ret['volist'];
            $data['totalRows'] = 1000;
            $data['curPage'] = $curPage;
            $this->ajaxReturn($data);
        }
        $appKey = sha1(C('API_ID')."UZ".C('API_KEY')."UZ".getMillisecond()).".".getMillisecond();
        $this->assign('appKey', $appKey);
        $this->display();
    }

    public function upfile()
    {
        $appKey = sha1(C('API_ID')."UZ".C('API_KEY')."UZ".getMillisecond()).".".getMillisecond();
        $this->assign('appKey', $appKey);
        $this->display();
    }

    public function delete($id ='')
    {
        $m = D('ApiCloud');
        $map['class'] = 'file';
        $ret = $m->where($map)->delete($id);
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
}
