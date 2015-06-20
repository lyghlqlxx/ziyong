<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    public $ac,$md,$con;
    public $uid,$user,$models,$model;

    public function _initialize (){
        $this->ac = ACTION_NAME;
        $this->con = CONTROLLER_NAME;
        $this->md = MODULE_NAME;


        $this->uid = session('uid');

        if ($this->ac != 'ckLogin') {
            if (!$this->uid) {
                $this->display('Public/login');
                exit();
            }
        }

        $this->assign('md', $this->md);
        $this->assign('ac', $this->ac);
        $this->assign('con', $this->con);
        $this->assign('uid', $this->uid);

        $this->assign('addUrl', U($this->con.'/add'));
        $this->assign('editUrl', U($this->con.'/edit?id='.I('id')));
        $this->assign('delUrl', U($this->con.'/delete?id='.I('id')));
        $this->assign('backUrl', U($this->con.'/index'));

        $this->assign('insertUrl', U($this->con.'/insert'));
        $this->assign('updateUrl', U($this->con.'/update'));
        $this->assign('updateField', U($this->con.'/updateField'));


        unset($map);
        if (S('cache_models')) {
            $this->models = S('cache_models');
        }else{
            $ApiCloud = D('ApiCloud');
            $map['class'] = 'ac_model';
            $data = $ApiCloud->getPage($map,1,100);
            $this->models = $data['volist'];
            S('cache_models',$this->models);
        }

        $this->assign('models',$this->models);
        foreach ($this->models as $k) {
            if (strtolower($k['name']) == strtolower($this->con)) {
                $this->model = $k;
                $this->assign('model',$this->model);
                F('ac_'.$this->con,$this->model);
                break;
            }
        }

    }


    public function add()
    {
        $tpl = T($this->md.'/add');
        $tpl = str_replace("./", "", $tp);

        if (!file_exists($tpl)) {
            $this->display('Common/add');
        }else{
            $this->display();
        }
    }

    public function insert()
    {
        $m = D('ApiCloud');
        $map['class'] = strtolower($this->con);
        $data = I('post.');
        $ret = $m->where($map)->add($data);
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

    public function edit($id ='')
    {
        $tpl = T($this->md.'/edit');
        $tpl = str_replace("./", "", $tp);
        $m = D('ApiCloud');
        $map['class'] = strtolower($this->con);
        $map['id'] = $id;
        $vo = $m->where($map)->find();
        $this->assign('vo',$vo);
        if (!file_exists($tpl)) {
            $this->display('Common/edit');
        }else{
            $this->display();
        }
    }

    public function update($id='')
    {
        $m = D('ApiCloud');
        $map['class'] = strtolower($this->con);
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
        $map['class'] = strtolower($this->con);
        $ret = $m->where($map)->delete($id);
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }


    public function index($curPage = 1,$limit = 10)
    {
        
        if (IS_POST) {
            $map['class'] = $this->con;
            $m = D('ApiCloud');
            $map['class'] = strtolower($this->con);
            $ret = $m->getPage($map,$curPage,$limit);
            $data['success'] = true;
            $data['data'] = $ret['volist'];
            $data['totalRows'] = $ret['count'];
            $data['curPage'] = $curPage;
            $this->ajaxReturn($data);
        }

        $tpl = T($this->md.'/index');
        $tpl = str_replace("./", "", $tp);

        if (!file_exists($tpl)) {
            $this->display('Common/index');
        }else{
            $this->display();
        }
    }
}
