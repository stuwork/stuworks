<?php

namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class SchoolController extends AdminbaseController {


    public function news() {
        $this->display(":School/news");
    }

    public function test(){
        $this->display(":School/test");
    }

    public function holiday(){
        $this->display(":School/holiday");
    }

}



