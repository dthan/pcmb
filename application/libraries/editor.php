<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 *  ======================================= 
 *  Author     : Muhammad Deden Firdaus
 *  License    : Protected 
 *  Email      : deden@if.uinsgd.ac.id
 *   
 *  Dilarang merubah, mengganti dan mendistribusikan 
 *  ulang tanpa sepengetahuan Author 
 *  ======================================= 
 */  
require_once APPPATH."/third_party/fckeditor/fckeditor.php"; 
 
class Editor extends FCKeditor { 
    public function __construct() { 
        parent::__construct(); 
    } 
}