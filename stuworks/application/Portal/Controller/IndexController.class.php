<?php

namespace Portal\Controller;
use Common\Controller\HomebaseController; 
/**
 * 首页
 */
class IndexController extends HomebaseController {
	

	public function index() {
    	$this->display(":index");
    }

    public function xiaoyuan(){
	    $this->display(":xiaoyuan");
    }

    public function manage(){
        $this->display(":manage");
    }

    public function down(){
        $this->display(":down");
    }

    public function login(){
        $this->display(":login");
    }

    public function register(){
        $this->display(":register");
    }

    public function login1(){
        $this->display(":login1");
    }

}


