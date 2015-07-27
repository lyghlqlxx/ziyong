<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends AcController {
    public function index($curPage =1,$pageSize = 10)
    {
        if (IS_POST) {
            $m = D('ApiCloud');
            $map['class'] = 'ac_user';
            $ret = $m->getPage($map,$curPage,10);

            $data['success'] = true;
            $data['data'] = $ret['volist'];
            $data['totalRows'] = $ret['count'];
            $data['curPage'] = $curPage;
            $this->ajaxReturn($data);
        }
        $this->display();
    }
    public function insert()
    {
        $password = I('password');
        if (strlen($password) < 5) {
            $this->error('密码长度必须大于6');
        }
        $_POST['password'] = md5($password);
        $m = D('ApiCloud');
        $map['class'] = 'ac_user';
        $data = I('post.');
        $ret = $m->where($map)->add($data);
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

    public function update($id='')
    {
        $password = I('password');
        if ($password) {
            if (strlen($password) < 5) {
                $this->error('密码长度必须大于6');
            }else{
                $_POST['password'] = md5($password);
            }
        }else{
            unset($_POST['password']);
        }
        $m = D('ApiCloud');
        $map['class'] = 'ac_user';
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

    public function delete($id ='')
    {
        $m = D('ApiCloud');
        $map['class'] = 'ac_user';
        $ret = $m->where($map)->delete($id);
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

    public function edit($id ='')
    {
        $m = D('ApiCloud');
        $map['class'] = 'ac_user';
        $map['id'] = $id;
        $vo = $m->where($map)->find();
        $this->assign('vo',$vo);
        $this->display();

    }
}
