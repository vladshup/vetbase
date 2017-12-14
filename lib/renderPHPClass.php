<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of renderPHPClass
 *
 * @author vova
 */
//Классс рендеринга динамических html-шаблонов
class renderPHPClass {
    
    public $o = array(); //массив подмен в шаблоне по маске ^xxx^

    private function replace_content($n){
            $this->o;
            return $this->o[$n[1]];
            }
    public function render($themplate){
    $c=file_get_contents($themplate);
    $html=preg_replace_callback( '/\^(.*)\^/Usi',array(&$this, 'replace_content'), $c);
    exit($html);
    }
    }
 

