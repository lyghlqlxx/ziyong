<?php
namespace Admin\Controller;
use Think\Controller;
class AcController extends Controller {
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
        $this->assign('models', $this->models);

        layout(true);
        if (array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX'])
        {
            layout(false);
        }

    }



    



}
