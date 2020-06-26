<?php

class Brands extends VS_Controller
{
    public $viewFolder = "";

    public function __construct(){

        parent::__construct();

        $this->viewFolder = "brands_v";

        $this->load->model("brand_model");

        if(!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $items = $this->brand_model->get_all(
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
            redirect(base_url("brands"));
        }

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function save(){

        if(!isAllowedWriteModule()){
            redirect(base_url("brands"));
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

            redirect(base_url("brands/new_form"));

            die();
        }

        $this->form_validation->set_rules("title", "Title", "required|trim");

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

            $image_350x216 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",350,216, $file_name);

            if($image_350x216){

                $insert = $this->brand_model->add(
                    array(
                        "title"         => $this->input->post("title"),
                        "img_url"       => $file_name,
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

                redirect(base_url("brands/new_form"));

                die();

            }

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("brands"));

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
            redirect(base_url("brands"));
        }

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->brand_model->get(
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
            redirect(base_url("brands"));
        }

        $this->load->library("form_validation");

        // Kurallar yazilir..

        $this->form_validation->set_rules("title", "Title", "required|trim");

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

                $image_350x216 = upload_picture($_FILES["img_url"]["tmp_name"], "uploads/$this->viewFolder",350,216, $file_name);

                if($image_350x216){

                    $data = array(
                        "title" => $this->input->post("title"),
                        "img_url" => $file_name,
                    );

                } else {

                    $alert = array(
                        "title" => "Transaction Failed",
                        "text" => "There was a problem loading the image",
                        "type" => "error"
                    );

                    $this->session->set_flashdata("alert", $alert);
                    redirect(base_url("brands/update_form/$id"));

                    die();
                }

            } else {
                $data = array(
                    "title" => $this->input->post("title"),
                );
            }
            $update = $this->brand_model->update(array("id" => $id), $data);

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

            redirect(base_url("brands"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->brand_model->get(
                array(
                    "id"    => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function delete($id){

        if(!isAllowedDeleteModule()){
            redirect(base_url("brands"));
        }

        $delete = $this->brand_model->delete(
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
                "title" => "Transaction Failed",
                "text" => "There was a problem deleting the record",
                "type"  => "error"
            );


        }

        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("brands"));


    }

    public function isActiveSetter($id){

        if(!isAllowedUpdateModule()){
           die();
        }

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->brand_model->update(
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

            $this->brand_model->update(
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
