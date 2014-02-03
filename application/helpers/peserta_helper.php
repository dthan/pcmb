<?php  if (!defined('BASEPATH')) exit('No direct script access allowed'); 

function posisi($link,$teks){
       $bread='<li><a href="'.$link.'">'.$teks.'</a> <span class="divider">/</span></li>';
       return $bread;
}