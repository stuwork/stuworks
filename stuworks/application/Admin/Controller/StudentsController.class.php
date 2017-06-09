<?php
/**
 * 后台首页
 */
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class StudentsController extends AdminbaseController {

    /**
     * 后台框架首页
     */
    public function index() {
        /*$this->load_menu_lang();
    	
        $this->assign("menus", D("Common/Menu")->menu_json());
       	$this->display();*/
        $this->display(":Students/index");
    }

    public function kebiao(){
        $this->display(":Students/kebiao");
    }


    public function upwork($flag=0){
        if($flag==1){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;
            $upload->rootPath = './Uploads/';
            $upload->savePath  = 'student/'; // 设置附件上传（子）目录
            $upload->saveName = array('uniqid','');
            $upload->exts     = '';
            $upload->autoSub  = true;
            $upload->subName  = array('date','Ymd');


            // 上传文件
            $info   =   $upload->upload();

            //存入数据库
            $file = M("upload"); // 实例化User对象
            $data['student_id'] = $_POST['student_id'];
            $data['teacher_id'] = $_POST['teacher_id'];
            $data['savepath'] = $info['photo1']["savepath"];
            $data['name'] = $info['photo1']["name"];
            $data['savename'] = $info['photo1']['savename'];
            $data['up_time'] = date("Y-m-d H:i:s");
            $data['work_name'] = $_POST['work_name'];
            $data['student_massage'] = $_POST['message'];
            $data['class_name'] = $_POST['class_name'];
            $data['timu_id'] = $_POST['timu_id'];
            $file->add($data);


            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                $this->success('上传成功！');
            }
        }
        else if($flag==2) {
            $this->assign('user_number', $_POST['user_number']);
            $this->display(":Students/load");
        }else{
            $this->display(":Students/upwork");
        }
    }


    public function status($flag=0){
        if($flag==0){
            $this->display(":Students/status");
        }
        else if($flag==2) {
            $this->assign('user_number', $_POST['user_number']);
            $this->display(":Students/status1");
        }
    }

    public function score($flag=0){
        if($flag==0){
            $this->display(":Students/score");
        }
        else if($flag==2) {
            $this->assign('user_number', $_POST['user_number']);
            $this->display(":Students/score1");
        }
    }


}



