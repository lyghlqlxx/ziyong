<?php
namespace Admin\Controller;
use Think\Controller;
class AcDataController extends AcController {
    public function index($model = '',$curPage =1,$pageSize = 10){
    	$m = F($model);
        $this->assign('cm', $m);
        $this->assign('model', $model);
        if (IS_POST) {
            $m = D('ApiCloud');
            $map['class'] = $model;
            $ret = $m->getPage($map,$curPage,(int)$pageSize);
            $data['success'] = true;
            $data['data'] = $ret['volist'];
            $data['totalRows'] = $ret['count'];
            $data['curPage'] = $curPage;
            $this->ajaxReturn($data);
        }
        $this->display();
    }

    public function add($model ='')
    {
    	$m = F($model);
        $this->assign('cm', $m);
        $this->assign('model', $model);
        $this->display();
    }

    public function edit($id ='',$model ='')
    {
    	$m = F($model);
        $this->assign('cm', $m);
        $m = D('ApiCloud');
        $map['class'] = $model;
        $map['id'] = $id;
        $vo = $m->where($map)->find();
        $this->assign('model',$model);
        $this->assign('vo',$vo);
        $this->display();

    }

    public function delete($id ='',$model ='')
    {
        $m = D('ApiCloud');
        $map['class'] = $model;
        $ret = $m->where($map)->delete($id);
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

    public function update($id='',$model ='')
    {
        $m = D('ApiCloud');
        $map['class'] = $model;
        $map['id'] = $id;
        $data = I('post.');
        unset($map['id']);
        $ret = $m->where($map)->save($data);
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

    public function insert($id='',$model ='')
    {
        $m = D('ApiCloud');
        $map['class'] = $model;
        $data = I('post.');
        unset($map['id']);
        $ret = $m->where($map)->add($data);
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }
}
