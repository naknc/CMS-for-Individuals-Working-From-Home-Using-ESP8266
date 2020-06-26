<?php

class Product extends VS_Controller
{
    public $viewFolder = "";

    public function __construct(){

        parent::__construct();

        $this->viewFolder = "product_v";

        $this->load->model("product_model");
        $this->load->model("product_image_model");

        if(!get_active_user()){
            redirect(base_url("login"));
        }

    }

    public function index(){

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $items = $this->product_model->get_all(
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
            redirect(base_url("product"));
        }


        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function save(){

        if(!isAllowedWriteModule()){
            redirect(base_url("product"));
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
        // TRUE - FALSE
        $validate = $this->form_validation->run();

        // Monitör Askısı
        // monitor-askisi

        if($validate){

            $insert = $this->product_model->add(
                array(
                    "title"         => $this->input->post("title"),
                    "description"   => $this->input->post("description"),
                    "url"           => convertToSEO($this->input->post("title")),
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

            // İşlemin Sonucunu Session'a yazma işlemi...
            $this->session->set_flashdata("alert", $alert);

            redirect(base_url("product"));

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
            redirect(base_url("product"));
        }

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->product_model->get(
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
            redirect(base_url("product"));
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
        // TRUE - FALSE
        $validate = $this->form_validation->run();

        // Monitör Askısı
        // monitor-askisi

        if($validate){

            $update = $this->product_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "title"         => $this->input->post("title"),
                    "description"   => $this->input->post("description"),
                    "url"           => convertToSEO($this->input->post("title")),
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
                    "text" => "There was a problem updating",
                    "type"  => "error"
                );


            }

            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("product"));

        } else {

            $viewData = new stdClass();

            /** Tablodan Verilerin Getirilmesi.. */
            $item = $this->product_model->get(
                array(
                    "id"    => $id,
                )
            );

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id){

        if(!isAllowedDeleteModule()){
            redirect(base_url("product"));
        }

        $delete = $this->product_model->delete(
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
        redirect(base_url("product"));


    }

    public function imageDelete($id, $parent_id){

        if(!isAllowedDeleteModule()){
            redirect(base_url("product"));
        }

        $fileName = $this->product_image_model->get(
            array(
                "id"    => $id
            )
        );

        $delete = $this->product_image_model->delete(
            array(
                "id"    => $id
            )
        );


        // TODO Alert Sistemi Eklenecek...
        if($delete){

            unlink("uploads/{$this->viewFolder}/$fileName->img_url");

            redirect(base_url("product/image_form/$parent_id"));
        } else {
            redirect(base_url("product/image_form/$parent_id"));
        }

    }

    public function isActiveSetter($id){

        if(!isAlloweUpdateModule()){
            die();
        }

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->product_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "isActive"  => $isActive
                )
            );
        }
    }

    public function imageIsActiveSetter($id){

        if(!isAllowedDeleteModule()){
            die();
        }

        if($id){

            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->product_image_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "isActive"  => $isActive
                )
            );
        }
    }

    public function isCoverSetter($id, $parent_id){

        if(!isAllowedUpdateModule()){
            die();
        }

        if($id && $parent_id){

            $isCover = ($this->input->post("data") === "true") ? 1 : 0;

            // Kapak yapılmak istenen kayıt
            $this->product_image_model->update(
                array(
                    "id"         => $id,
                    "product_id" => $parent_id
                ),
                array(
                    "isCover"  => $isCover
                )
            );


            // Kapak yapılmayan diğer kayıtlar
            $this->product_image_model->update(
                array(
                    "id !="      => $id,
                    "product_id" => $parent_id
                ),
                array(
                    "isCover"  => 0
                )
            );

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "image";

            $viewData->item_images = $this->product_image_model->get_all(
                array(
                    "product_id"    => $parent_id
                ), "rank ASC"
            );

            $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);

            echo $render_html;

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

            $this->product_model->update(
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

    public function imageRankSetter(){

        if(!isAllowedUpdateModule()){
            die();
        }

        $data = $this->input->post("data");

        parse_str($data, $order);

        $items = $order["ord"];

        foreach ($items as $rank => $id){

            $this->product_image_model->update(
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

    public function image_form($id){

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->item = $this->product_model->get(
            array(
                "id"    => $id
            )
        );

        $viewData->item_images = $this->product_image_model->get_all(
            array(
                "product_id"    => $id
            ), "rank ASC"
        );

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function image_upload($id){

        if(!isAllowedWriteModule()){
            redirect(base_url("product"));
        }

        $file_name = convertToSEO(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

        $image_348x215 = upload_picture($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder",348,215, $file_name);
        $image_1080x426 = upload_picture($_FILES["file"]["tmp_name"], "uploads/$this->viewFolder",1080,426, $file_name);

        if($image_348x215 && $image_1080x426){

            $this->product_image_model->add(
                array(
                    "img_url"       => $file_name,
                    "rank"          => 0,
                    "isActive"      => 1,
                    "isCover"       => 0,
                    "createdAt"     => date("Y-m-d H:i:s"),
                    "product_id"    => $id
                )
            );


        } else {
            echo "Transaction Failed";
        }

    }

    public function refresh_image_list($id){

        if(!isAllowedViewModule()){
            redirect(base_url("product"));
        }

        $viewData = new stdClass();

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->item_images = $this->product_image_model->get_all(
            array(
                "product_id"    => $id
            )
        );

        $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);

        echo $render_html;

    }

}
