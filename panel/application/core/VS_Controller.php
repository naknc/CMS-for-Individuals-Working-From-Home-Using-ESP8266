<?php 

class VS_Controller extends CI_Controller
    {
 
        public function __construct(){
 
            parent::__construct();
            
            if(get_active_user()){
                if(!isAllowedViewModule()){
                        redirect(base_url());
                    }
            }
        }
            
    }