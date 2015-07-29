<?php
namespace Admin\Controller;
use Think\Controller;
class AcFormController extends AcController {
    public function index($curPage = 1){
    	if(IS_POST){
    		$ApiCloud = D('ApiCloud');
	        $map['class'] = 'ac_model';
	        $ret = $ApiCloud->getPage($map,$curPage);
	        $data['success'] = true;
	        $data['data'] = $ret['volist'];
	        $data['totalRows'] = $ret['count'];
	        $data['curPage'] = 1;
	        $this->ajaxReturn($data);
    	}
        $this->display();
    }

    public function add()
    {
        $this->display();
    }

    public function edit($id='')
    {
    	$map['class'] = 'ac_model';
        $map['id'] = $id;
        $ApiCloud = D('ApiCloud');
        $vo = $ApiCloud->where($map)->find();
        $this->assign('vo', $vo);
        $this->display();
    }

    public function update($title = '')
    {
        S('cache_models',null);
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


    public function insert()
    {

        S('cache_models',null);
        $ApiCloud = D('ApiCloud');
        $name = I('name');
        if (!$name) {
            $this->error('模型名称不能为空');
        }
        $map['class'] = $name;
        $ret = $ApiCloud->where($map)->find();

        unset($map);

        $map['name'] = $name;
        $map['class'] = 'ac_model';
        $vo = $ApiCloud->where($map)->find();
        if ($vo) {
            $this->error('该模型已经存在，请不要重复添加');
        }

        $data = $_POST;
        $data['class'] = 'ac_model';

        $data['fields'] = dataToFields($ret);
        $ret = $ApiCloud->add($data);
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
    }

    public function delete($id ='')
    {
        $ApiCloud = D('ApiCloud');
        $map['id'] = $id;
        $map['class'] = 'ac_model';
        $ret = $ApiCloud->where($map)->delete();
        S('cache_models',null);
        if ($ret !== FALSE) {
            $this->success('操作成功');
        }else{
            $this->error('操作失败');
        }
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
}
