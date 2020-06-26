<?php

class Settings extends VS_Controller
{
    public $viewFolder = "";

    public function __construct(){

        parent::__construct();

        $this->viewFolder = "settings_v";

        $this->load->model("settings_model");

        if(!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->settings_model->get();

        if($item)
            $viewData->subViewFolder = "update";
        else
            $viewData->subViewFolder = "no_content";

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form(){

        if(!isAllowedWriteModule()){
            redirect(base_url("settings"));
        }

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function save(){

        if(!isAllowedWriteModule()){
            redirect(base_url("settings"));
        }

        $this->load->library("form_validation");

        // Kurallar yazilir..

        $this->form_validation->set_rules("company_name", "Company Name", "required|trim");
        $this->form_validation->set_rules("phone_1", "Phone 1", "required|trim");
        $this->form_validation->set_rules("email", "E-mail Address", "required|trim|valid_email");

        $this->form_validation->set_message(
            array(
                "required"     => "<b>{field}</b> must be filled",
                "valid_email"  => "Please enter a valid <b>{field}</b>"
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){

            // Upload Süreci...

            $file_name = convertToSEO($this->input->post("company_name")) . "." . pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);

                $insert = $this->settings_model->add(
                    array(
                        "company_name"  => $this->input->post("company_name"),
                        "phone_1"       => $this->input->post("phone_1"),
                        "phone_2"       => $this->input->post("phone_2"),
                        "fax_1"         => $this->input->post("fax_1"),
                        "fax_2"         => $this->input->post("fax_2"),
                        "address"       => $this->input->post("address"),
                        "about_us"      => $this->input->post("about_us"),
                        "mission"       => $this->input->post("mission"),
                        "vision"        => $this->input->post("vision"),
                        "email"         => $this->input->post("email"),
                        "facebook"      => $this->input->post("facebook"),
                        "twitter"       => $this->input->post("twitter"),
                        "instagram"     => $this->input->post("instagram"),
                        "linkedin"      => $this->input->post("linkedin"),
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

                $this->session->set_flashdata("alert", $alert);

                redirect(base_url("settings/new_form"));

                die();

            
            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("settings"));

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
            redirect(base_url("settings"));
        }

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->settings_model->get(
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
            redirect(base_url("settings"));
        }
        
        $this->load->library("form_validation");

        // Kurallar yazilir..

        $this->form_validation->set_rules("company_name", "Company Name", "required|trim");
        $this->form_validation->set_rules("phone_1", "Phone 1", "required|trim");
        $this->form_validation->set_rules("email", "E-mail Address", "required|trim|valid_email");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> must be filled",
                "valid_email"  => "Please enter a valid <b>{field}</b>"
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){


            $data = array(
                "company_name"  => $this->input->post("company_name"),
                "phone_1"       => $this->input->post("phone_1"),
                "phone_2"       => $this->input->post("phone_2"),
                "fax_1"         => $this->input->post("fax_1"),
                "fax_2"         => $this->input->post("fax_2"),
                "address"       => $this->input->post("address"),
                "about_us"      => $this->input->post("about_us"),
                "mission"       => $this->input->post("mission"),
                "vision"        => $this->input->post("vision"),
                "email"         => $this->input->post("email"),
                "facebook"      => $this->input->post("facebook"),
                "twitter"       => $this->input->post("twitter"),
                "instagram"     => $this->input->post("instagram"),
                "linkedin"      => $this->input->post("linkedin"),
                "updatedAt"     => date("Y-m-d H:i:s")
            );

            $update = $this->settings_model->update(array("id" => $id), $data);

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


            // Session Update İşlemi

            $settings = $this->settings_model->get();
            $this->session->set_userdata("settings", $settings);

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("settings"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->settings_model->get(
                array(
                    "id"    => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }
}
