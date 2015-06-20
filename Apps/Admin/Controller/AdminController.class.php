<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends CommonController {
    public function index(){
        $this->display();
    }

    public function getAllModels($curPage = 1,$limit = 6)
    {
        $ApiCloud = D('ApiCloud');
        $map['class'] = 'ac_model';
        $ret = $ApiCloud->getPage($map,$curPage,$limit);
        $data['success'] = true;
        $data['data'] = $ret['volist'];
        $data['totalRows'] = $ret['count'];
        $data['curPage'] = 1;
        $this->ajaxReturn($data);
    }


    public function deleteModel($id ='')
    {
        $map['class'] = 'ac_model';
        $map['id'] = $id;
        $ApiCloud = D('ApiCloud');
        $ret = $ApiCloud->where($map)->delete();
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

    public function editModel($id ='')
    {
        $map['class'] = 'ac_model';
        $map['id'] = $id;
        $ApiCloud = D('ApiCloud');
        $vo = $ApiCloud->where($map)->find();
        $this->assign('vo', $vo);
        $this->display();
    }

    public function updateModel($title = '')
    {
        $ApiCloud = D('ApiCloud');
        $map['class'] = 'ac_model';
        $data = $_POST;
        $ret = $ApiCloud->where($map)->save($data);
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

    public function saveModel()
    {
        
        $ApiCloud = D('ApiCloud');
        $name = I('name');
        if (!$name) {
            $this->error('模型名称不能为空');
        }
        $map['class'] = $name;
        $ret = $ApiCloud->where($map)->find();
        if (!$ret) {
            $this->error('模型不存在，请确定模型存在数据');
        }
        unset($map);

        $map['name'] = $name;
        $map['class'] = 'ac_model';
        $vo = $ApiCloud->where($map)->find();
        if ($vo) {
            $this->error('该模型已经存在，请不要重复添加');
        }

        $data = $_POST;
        $data['fields'] = dataToFields($ret);
        // exit();
        $data['class'] = 'ac_model';
        if ($data['id']) {
            $map['id'] = $data['id'];
            $map['class'] = 'ac_model';
            $ret = $ApiCloud->where($map)->save($data);
        }else{
            $ret = $ApiCloud->add($data);
        }
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }


    public function getAllUsers($curPage = 1,$limit = 6)
    {
        $ApiCloud = D('ApiCloud');
        $map['class'] = 'ac_user';
        $ret = $ApiCloud->getPage($map,$curPage,$limit);
        $data['success'] = true;
        $data['data'] = $ret['volist'];
        $data['totalRows'] = $ret['count'];
        $data['curPage'] = 1;

        $this->ajaxReturn($data);
    }


    public function saveUser()
    {
        $data = $_POST;
        $data['class'] = 'ac_user';
        $ApiCloud = D('ApiCloud');
        if ($data['id']) {
            $map['id'] = $data['id'];
            $map['class'] = 'ac_user';
            if ($data['password']) 
                $data['password'] = md5($data['password']);
            else
                unset($data['password']);
            $ret = $ApiCloud->where($map)->save($data);
        }else{
            $map['class'] = 'ac_user';
            $map['account'] = I('account');
            $vo = $ApiCloud->where($map)->find();
            if ($vo) {
                $this->error('该登陆账号已经存在');
                return;
            }

            $data['password'] = md5($data['password']);
            $ret = $ApiCloud->add($data);
        }
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

    public function deleteUser($id ='')
    {
        $map['class'] = 'ac_user';
        $map['id'] = $id;
        $ApiCloud = D('ApiCloud');
        $ret = $ApiCloud->where($map)->delete();
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

    public function editUser($id ='')
    {
        $map['class'] = 'ac_user';
        $map['id'] = $id;
        $ApiCloud = D('ApiCloud');
        $vo = $ApiCloud->where($map)->find();
        $this->assign('vo', $vo);
        $this->display();
    }


    public function design($name ='')
    {
        if ($name) {
            $map['class'] = 'ac_model';
            $map['name'] = $name;
            $ApiCloud = D('ApiCloud');
            $vo = $ApiCloud->where($map)->find();
            $this->assign('vo', $vo);
        }
        $this->display();
    }

    public function updateField($mName='',$name = '',$value = '',$pk = '')
    {
        if (!$mName) $this->error('请选择正确的模型');
        $map['class'] = 'ac_model';
        $map['name'] = $mName;
        $ApiCloud = D('ApiCloud');
        $vo = $ApiCloud->where($map)->find();
        if (!$vo) $this->error('所更新的模型不存在');
        $field = $vo['fields'][$pk];
        $field[$name] = $value;
        $vo['fields'][$pk] = $field;

        unset($map);
        $map['class'] = 'ac_model';
        $map['id'] = $vo['id'];
        $ret = $ApiCloud->where($map)->save($vo);
        $this->success('更新成功');
    }
}
