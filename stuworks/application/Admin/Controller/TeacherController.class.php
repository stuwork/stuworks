<?php

namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class TeacherController extends AdminbaseController {


    public function index() {
        $this->display(":Teacher/index");
    }

    public function works() {
        if($_POST["end_time"] != ''){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;
            $upload->rootPath = './Uploads/';
            $upload->savePath  = 'teacher/'; // 设置附件上传（子）目录
            $upload->saveName = array('uniqid','');
            $upload->exts     = '';
            $upload->autoSub  = true;
            $upload->subName  = array('date','Ymd');


            // 上传文件
            $info   =   $upload->upload();

            //存入数据库
            $file = M("tea_upload"); // 实例化User对象
            $data['teacher_id'] = $_POST['teacher_id'];
            $data['savepath'] = $info['photo1']["savepath"];
            $data['name'] = $info['photo1']["name"];
            $data['savename'] = $info['photo1']['savename'];
            $data['up_time'] = date("Y-m-d H:i:s");
            $data['work_name'] = $_POST['work_name'];
            $data['class_name'] = $_POST['class_name'];
            $data['end_time'] = $_POST['end_time'];
            $data['message'] = $_POST['message'];
            $file->add($data);


            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                $this->success('上传成功！');
            }
        }
        else{
            $this->display(":Teacher/works");
        }
    }

    public function status($flag=0) {
        if ($flag==1) {
            $this->assign('timu_id', $_POST['id']);
            $this->display(":Teacher/status1");
        }
        else {
            $this->display(":Teacher/status");
        }
    }

    public function correct($flag=0) {
        if ($flag==1) {
            $this->assign('timu_id', $_POST['id']);
            $this->display(":Teacher/correct1");
        }
        else if ($flag==2){
            $http = new \Org\Net\Http();
            $id = $_POST['id'];//GET方式传到此方法中的参数id,即文件在数据库里的保存id.根据之查找文件信息。
            if ($id == '') {//如果id为空
                $this->error('下载失败！', '', 1);
            }
            $file = M("tea_upload");

            $result = $file->find($id);//根据id查询到文件信息
            $uploadpath = "./Uploads/" . $result['savepath'];
            if ($result == false) //如果查询不到文件信息
            {
                $this->error('下载失败！', '', 1);
            } else {
                $savename = $result['savename'];//文件保存名
                $showname = $result['name'];//文件原名
                $filename = $uploadpath.$savename;//完整文件名（路径加名字）
                import('ORG.Net.Http');
                $http->download($filename, $showname);
            }
        }
        else if($flag==3){

        }
        else {
            $this->display(":Teacher/correct");
        }
    }



}



