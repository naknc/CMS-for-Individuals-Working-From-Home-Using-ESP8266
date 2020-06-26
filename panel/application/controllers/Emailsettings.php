<?php

class Emailsettings extends VS_Controller
{
    public $viewFolder = "";

    public function __construct(){

        parent::__construct();

        $this->viewFolder = "email_settings_v";

        $this->load->model("emailsettings_model");

        if(!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $items = $this->emailsettings_model->get_all(
            array()
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form(){

        if(!isAllowedWriteModule()){
            redirect(base_url("email_settings"));
        }

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function save(){

        if(!isAllowedWriteModule()){
            redirect(base_url("email_settings"));
        }

        $this->load->library("form_validation");

        // Kurallar yazilir..
        $this->form_validation->set_rules("protocol", "Protocol Number", "required|trim");
        $this->form_validation->set_rules("host", "E-mail Host", "required|trim");
        $this->form_validation->set_rules("port", "Port Number", "required|trim");
        $this->form_validation->set_rules("user_name", "User Name", "required|trim");
        $this->form_validation->set_rules("user", "E-mail (User)", "required|trim|valid_email");
        $this->form_validation->set_rules("from", "From", "required|trim|valid_email");
        $this->form_validation->set_rules("to", "To", "required|trim|valid_email");
        $this->form_validation->set_rules("password", "Password", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"    => "<b>{field}</b> must be filled",
                "valid_email" => "Please enter a valid e-mail address",
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){

            $insert = $this->emailsettings_model->add(
                array(
                    "protocol"      => $this->input->post("protocol"),
                    "host"          => $this->input->post("host"),
                    "port"          => $this->input->post("port"),
                    "user_name"     => $this->input->post("user_name"),
                    "user"          => $this->input->post("user"),
                    "from"          => $this->input->post("from"),
                    "to"            => $this->input->post("to"),
                    "password"      => $this->input->post("password"),
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

            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("emailsettings"));

            die();

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
            redirect(base_url("email_settings"));
        }

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->emailsettings_model->get(
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
            redirect(base_url("email_settings"));
        }

        $this->load->library("form_validation");

        $this->form_validation->set_rules("protocol", "Protocol Number", "required|trim");
        $this->form_validation->set_rules("host", "E-mail Host", "required|trim");
        $this->form_validation->set_rules("port", "Port Number", "required|trim");
        $this->form_validation->set_rules("user_name", "User Name", "required|trim");
        $this->form_validation->set_rules("user", "E-mail (User)", "required|trim|valid_email");
        $this->form_validation->set_rules("from", "From", "required|trim|valid_email");
        $this->form_validation->set_rules("to", "To", "required|trim|valid_email");
        $this->form_validation->set_rules("password", "Password", "required|trim");


        $this->form_validation->set_message(
            array(
                "required"    => "<b>{field}</b> must be filled",
                "valid_email" => "Please enter a valid e-mail address",
            )
        );

        // Form Validation Calistirilir..
        $validate = $this->form_validation->run();

        if($validate){

            // Upload Süreci...
            $update = $this->emailsettings_model->update(
                array("id" => $id),
                array(
                    "protocol"      => $this->input->post("protocol"),
                    "host"          => $this->input->post("host"),
                    "port"          => $this->input->post("port"),
                    "user_name"     => $this->input->post("user_name"),
                    "user"          => $this->input->post("user"),
                    "from"          => $this->input->post("from"),
                    "to"            => $this->input->post("to"),
                    "password"      => $this->input->post("password"),
                )
            );

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

            redirect(base_url("emailsettings"));

        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;

            /** Tablodan Verilerin Getirilmesi.. */
            $viewData->item = $this->emailsettings_model->get(
                array(
                    "id"    => $id,
                )
            );

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function delete($id){

        if(!isAllowedDeleteModule()){
            redirect(base_url("email_settings"));
        }

        $delete = $this->emailsettings_model->delete(
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
        redirect(base_url("emailsettings"));


    }

    public function isActiveSetter($id){

        if(!isAllowedUpdateModule()){
            redirect(base_url("email_settings"));
        }

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->emailsettings_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "isActive"  => $isActive
                )
            );
        }
    }

}
