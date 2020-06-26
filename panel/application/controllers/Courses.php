<?php

class Courses extends VS_Controller
{
    public $viewFolder = "";

    public function __construct(){

        parent::__construct();

        $this->viewFolder = "courses_v";

        $this->load->model("course_model");

        if(!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $items = $this->course_model->get_all(
            array(), "rank ASC"
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form(){

        if(!isAllowedWriteModule()){
            redirect(base_url("courses"));
        }


        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function save(){

        if(!isAllowedWriteModule()){
            redirect(base_url("courses"));
        }

        $this->load->library("form_validation");

        // Kurallar yazilir..

        if($_FILES["img_url"]["name"] == ""){

            $alert = array(
                "title" => "Transaction Failed",
                "text" => "Please select an image",
                "type"  => "error"
            );

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("courses/new_form"));

            die();
        }

        $this->form_validation->set_rules("title", "Title", "required|trim");
        $this->form_validation->set_rules("event_date", "Course Date", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> must be filled"
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){

            // Upload Süreci...

            $file_name = convertToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

            $image_255x157 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",255,157, $file_name);
            $image_1140x705 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",1140,705, $file_name);

            if($image_255x157 && $image_1140x705){

                $insert = $this->course_model->add(
                    array(
                        "title"         => $this->input->post("title"),
                        "description"   => $this->input->post("description"),
                        "url"           => convertToSEO($this->input->post("title")),
                        "img_url"       => $file_name,
                        "event_date"    => $this->input->post("event_date"),
                        "rank"          => 0,
                        "isActive"      => 1,
                        "createdAt"     => date("Y-m-d H:i:s")
                    )
                );

                // TODO Alert sistemi eklenecek...
                if($insert){

                    $alert = array(
                        "title" => "Operation Successful",
                        "text" => "Registration was successfully added",
                        "type"  => "success"
                    );

                } else {

                    $alert = array(
                        "title" => "Transaction Failed",
                        "text" => "There was a problem adding a record",
                        "type"  => "error"
                    );
                }

            } else {

                $alert = array(
                    "title" => "Transaction Failed",
                    "text" => "There was a problem loading the image",
                    "type"  => "error"
                );

                $this->session->set_flashdata("alert", $alert);

                redirect(base_url("courses/new_form"));

                die();

            }

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("courses"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function update_form($id){

        if(!isAllowedUpdateModule()){
            redirect(base_url("courses"));
        }

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->course_model->get(
            array(
                "id"    => $id,
            )
        );
        
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


    }

    public function update($id){

        if(!isAllowedUpdateModule()){
            redirect(base_url("courses"));
        }

        $this->load->library("form_validation");

        // Kurallar yazilir..

        $this->form_validation->set_rules("title", "Title", "required|trim");
        $this->form_validation->set_rules("event_date", "Course Date", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> must be filled"
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){

            // Upload Süreci...
            if($_FILES["img_url"]["name"] !== "") {

                $file_name = convertToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

                $image_255x157 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",255,157, $file_name);
                $image_1140x705 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",1140,705, $file_name);

                if($image_255x157 && $image_1140x705){

                    $data = array(
                        "title" => $this->input->post("title"),
                        "description" => $this->input->post("description"),
                        "event_date"  => $this->input->post("event_date"),
                        "url" => convertToSEO($this->input->post("title")),
                        "img_url" => $file_name,
                    );

                } else {

                    $alert = array(
                        "title" => "Transaction Failed",
                        "text" => "There was a problem loading the image",
                        "type" => "error"
                    );

                    $this->session->set_flashdata("alert", $alert);

                    redirect(base_url("courses/update_form/$id"));

                    die();

                }

            } else {

                $data = array(
                    "title" => $this->input->post("title"),
                    "description" => $this->input->post("description"),
                    "event_date"  => $this->input->post("event_date"),
                    "url" => convertToSEO($this->input->post("title")),
                );

            }

            $update = $this->course_model->update(array("id" => $id), $data);

            // TODO Alert sistemi eklenecek...
            if($update){

                $alert = array(
                    "title" => "Operation Successful",
                    "text" => "Registration was updated successfully",
                    "type"  => "success"
                );

            } else {

                $alert = array(
                    "title" => "Transaction Failed",
                    "text" => "There was a problem updating the registry",
                    "type"  => "error"
                );
            }

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("courses"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->course_model->get(
                array(
                    "id"    => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function delete($id){

        if(!isAllowedDeleteModule()){
            redirect(base_url("courses"));
        }

        $delete = $this->course_model->delete(
            array(
                "id"    => $id
            )
        );

        // TODO Alert Sistemi Eklenecek...
        if($delete){

            $alert = array(
                "title" => "Operation Successful",
                "text" => "Record successfully deleted",
                "type"  => "success"
            );

        } else {

            $alert = array(
                "title" => "Operation Successful",
                "text" => "There was a problem deleting the record",
                "type"  => "error"
            );


        }

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("courses"));


    }

    public function isActiveSetter($id){

        if(!isAllowedUpdateModule()){
            die();
        }

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->course_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "isActive"  => $isActive
                )
            );
        }
    }

    public function rankSetter(){

        if(!isAllowedUpdateModule()){
            die();
        }

        $data = $this->input->post("data");

        parse_str($data, $order);

        $items = $order["ord"];

        foreach ($items as $rank => $id){

            $this->course_model->update(
                array(
                    "id"        => $id,
                    "rank !="   => $rank
                ),
                array(
                    "rank"      => $rank
                )
            );

        }

    }

}
