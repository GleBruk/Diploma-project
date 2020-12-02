<?php

    class About extends Controller{
        // Вызываем шаблон
        public function index(){
            $this->view('about/index');
        }
    }