<?php

namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class WorkController extends AdminbaseController {


    public function inform() {
        $this->display(":Work/index");
    }

    public function load($flag=0) {
        if ($flag==1) {
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
        else if($flag==0) {
            $this->display(":Work/status");
        }
        else if($flag==2){
            $this->assign('user_number', $_POST['user_number']);
            $this->display(":Work/load");
        }
    }

}



