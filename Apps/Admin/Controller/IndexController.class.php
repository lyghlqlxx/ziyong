<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends AcController {
    public function index(){
        redirect(U('AcForm/index'));
    }
}
