<?php
namespace Admin\Controller;
use Think\Controller;
class AcUserController extends AcController {
    public function index($curPage =1,$pageSize = 10)
    {
        if (IS_POST) {
            $m = D('ApiCloud');
            $map['class'] = 'user';
            $ret = $m->getPage($map,$curPage,10);

            $data['success'] = true;
            $data['data'] = $ret['volist'];
            $data['totalRows'] = $ret['count'];
            $data['curPage'] = $curPage;
            $this->ajaxReturn($data);
        }
        $this->display();
    }
}
