<?php

function convertToSEO($text){

    $turkce = array("ç", "Ç", "ğ", "Ğ", "ü", "Ü", "ö", "Ö", "ı", "İ", "ş", "Ş", ".", ",", "!", "'", "\"", " ", "?", "*", "_", "|", "=", "(", ")", "[", "]", "{", "}");
    $convert = array("c", "c", "g", "g", "u", "u", "o", "o", "i", "i", "s", "s", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-", "-");

    return strtolower(str_replace($turkce, $convert, $text));

}

function get_readable_date($date){
    return strftime('%e %B %Y', strtotime($date));
}

function get_active_user(){

    $t = &get_instance();

    $user = $t->session->userdata("user");

    if($user)
        {return $user;}
    else
        return false;

}

function get_user_roles(){

    $t = &get_instance();
    return $t->session->userdata("user_roles");
}

function setUserRoles(){

    $t = &get_instance();

    $t->load->model("user_role_model");

    $user_roles = $t->user_role_model->get_all(
        array(
            "isActive"  => 1
        )
    );

    $roles = [];
    foreach ($user_roles as $role){
        $roles[$role->id] = $role->permissions;
    }
    $t->session->set_userdata("user_roles", $roles);
    

}

function getControllerList(){

    $t = &get_instance();

    $controllers = array();
    $t->load->helper("file");

    $files = get_dir_file_info(APPPATH. "controllers", FALSE);

    foreach (array_keys($files) as $file){
        if($file !== "index.html"){
            $controllers[] = strtolower(str_replace(".php", '', $file));
        }
    }

    return $controllers;

}

function send_email($toEmail = "", $subject = "", $message = ""){
    
    $t = &get_instance();

    $t->load->model("emailsettings_model");

    $email_settings = $t->emailsettings_model->get(
        array(
            "isActive"  => 1
        )
    );

    $config = array(

        "protocol"   => $email_settings->protocol,
        "smtp_host"  => $email_settings->host,
        "smtp_port"  => $email_settings->port,
        "smtp_user"  => $email_settings->user,
        "smtp_pass"  => $email_settings->password,
        "starttls"   => true,
        "charset"    => "utf-8",
        "mailtype"   => "html",
        "wordwrap"   => true,
        "newline"    => "\r\n"
    );

    $t->load->library("email", $config);

    $t->email->from($email_settings->from, $email_settings->user_name);
    $t->email->to($toEmail);
    $t->email->subject($subject);
    $t->email->message($message);

    return $t->email->send();

}

function get_settings(){

    $t = &get_instance();

    $t->load->model("settings_model");

    if($t->session->userdata("settings")){
        $settings = $t->session->userdata("settings");
    } else {

        $settings = $t->settings_model->get();

        if(!$settings) {

            $settings = new stdClass();
            $settings->company_name = "default";
            
        }

        $t->session->set_userdata("settings", $settings);

    }

    return $settings;

}

function get_category_title($category_id = 0){

    $t = &get_instance();

    $t->load->model("portfolio_category_model");

    $category = $t->portfolio_category_model->get(
        array(
            "id"    => $category_id
        )
    );

    if($category)
        return $category->title;
    else
        return "<b style='color:red'>Not Defined</b>";

}

function upload_picture($file, $uploadPath, $width, $height, $name){

    $t = &get_instance();
    $t->load->library("simpleimagelib");


    if(!is_dir("{$uploadPath}/{$width}x{$height}")){
        mkdir("{$uploadPath}/{$width}x{$height}");
    }

    $upload_error = false;
    try {

        $simpleImage = $t->simpleimagelib->get_simple_image_instance();

        $simpleImage
            ->fromFile($file)
            ->thumbnail($width,$height,'center')
            ->toFile("{$uploadPath}/{$width}x{$height}/$name", null, 75);

    } catch(Exception $err) {
        $error =  $err->getMessage();
        $upload_error = true;
    }

    if($upload_error){
        echo $error;
    } else {
        return true;
    }


}

function get_picture($path = "", $picture = "", $resolution = "50x50"){

    if($picture != ""){

        if(file_exists(FCPATH . "uploads/$path/$resolution/$picture")){
            $picture = base_url("uploads/$path/$resolution/$picture");
        } else {
            $picture = base_url("assets/assets/images/default_image.png");

        }

    } else {

        $picture = base_url("assets/assets/images/default_image.png");

    }

    return $picture;

}

function get_page_list($page){

    $page_list = array(
        "home_v"                => "Home page",
        "about_v"               => "About Us Page",
        "news_list_v"           => "News Page",
        "galleries"             => "Gallery Page",
        "portfolio_list_v"      => "Portfolio Page",
        "reference_list_v"      => "References Page",
        "service_list_v"        => "Services Page",
        "course_list_v"         => "Trainings Page",
        "brand_list_v"          => "Brands Page",
        "contact_v"             => "Contact Page",
    );

    return (empty($page)) ? $page_list : $page_list[$page];
}

?>
