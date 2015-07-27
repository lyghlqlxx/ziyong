<?php
namespace Admin\Controller;
use Think\Controller;
class AcFormFieldController extends AcController {
    public function index($curPage = 1,$id = '')
    {
		$ApiCloud = D('ApiCloud');
        $map['class'] = 'ac_model';
        $map['id'] = $id;
        $ret = $ApiCloud->where($map)->find();
        $fields = $ret['fields'];
        $data =  array();
        foreach ($fields as $k) {
            $data[] = $k;
        }
        $this->assign('mName',$ret['name']);
        $this->assign('data',$data);
        $this->assign('id',$id);
        $this->assign('name',$ret['name']);
        $this->display();
    }

    public function insert($id='')
    {
        $map['class'] = 'ac_model';
        $map['id'] = $id;
        $ApiCloud = D('ApiCloud');
        $r = $ApiCloud->where($map)->find();
        if (!$r) $this->error('所更新的模型不存在');
        if ($r) {
            $name = I('name');
            $vo ['name'] = I('name');
            $vo ['label'] = I('label');
            $vo ['col'] = 4;
            $vo ['type'] = 'text';
            $vo['actype'] = 'String';
            $vo['showList'] = 1;
            $vo['showAdd'] = 1;
            $vo['showEdit'] = 1;
            $r['fields'][$name] = $vo;

            unset($map);
            $map['class'] = 'ac_model';
            $map['id'] = $id;

            // $data['id'] = $id;
            $data['fields'] = $r['fields'];
            $ApiCloud = D('ApiCloud');
            $ret = $ApiCloud->where($map)->save($data);
            $this->success('更新成功');
        }else {
            $this->error('新增失败');
        }
    }

    public function add($id = '')
    {
        $this->assign('id',$id);
        $this->display();
    }

    public function delete($id='',$name = '')
    {
        $map['class'] = 'ac_model';
        $map['id'] = $id;
        $ApiCloud = D('ApiCloud');
        $vo = $ApiCloud->where($map)->find();
        if (!$vo) $this->error('所更新的模型不存在');
        $fields = $vo['fields'];
        unset($fields[$name]);


        unset($map);
        $map['class'] = 'ac_model';
        $map['id'] = $id;

        $data['fields'] = $fields;
        $ApiCloud = D('ApiCloud');
        $ret = $ApiCloud->where($map)->save($data);
        $this->success('删除成功',U('AcFormField/index?id='.$id));
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

    public function create($id ='')
    {
        $map['class'] = 'ac_model';
        $map['id'] = $id;
        $ApiCloud = D('ApiCloud');
        $vo = $ApiCloud->where($map)->find();
        $name = $vo['name'];
        $name = strtolower($name);
        F($name,null);
        F($name,$vo);
        $this->success('操作成功');
    }
}
