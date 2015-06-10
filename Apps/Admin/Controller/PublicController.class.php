<?php
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function ckLogin($account ='',$password=''){
        if(!$account || !$password)
        {
            $this->error('请输入登陆账号和密码');
        }

        if ($account == C('API_ID') && $password == C('API_KEY')) {
            $ApiCloud = D('ApiCloud');
            $map['class'] = 'role';
            $vo = $ApiCloud->where($map)->find();
            if ($vo !== FLASE) {
                session('uid',1);
                session('rid',1);
                session('admin','yes');
                $this->success('登陆成功','index.php');
            }else{
                $this->error('登陆失败，请检查配置文件或输入的参数');
            }
        }

        $ApiCloud = D('ApiCloud');
        $map['class'] = 'ac_user';
        $map['account'] = $account;
        $map['password'] = md5($account);
        $vo = $ApiCloud->where($map)->find();
        if ($vo) {
            session('uid',$vo['id']);
            $this->success('登陆成功','index.php');
        }else{
            $this->error('登陆失败，登录名或者密码错误');
        }

    }

    public function logout()
    {
        session(null);
        redirect('index.php');
    }
}
