<?php

    class Home extends Controller {
        public function index(){
            $links = $this->model('LinksModel');

            if (isset($_POST['long_link'])){
                $links->setData($_POST['long_link'], $_POST['short_link'], $_COOKIE['login']);

                $isValid = $links->validLinks();
                if($isValid == "Верно")
                    $links->sendLinks();
                else
                    $data['message'] = $isValid;
            }

            if(isset($_POST['link_id_delete'])) {
                $links->deleteLink($_POST['link_id_delete']);
            }

            $data['links'] = $links->getLinks();

            $this->view('home/index', $data);
        }
    }