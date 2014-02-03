<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_admin extends CI_Model {
  
    public function cek_login($username,$password){
         $q=$this->db->query("select * from admin where username='".$username."' and password='".$password."'");
         if($q->num_rows() == 1){
         	return true;
         }
         else {
         	return false;
         }
    }

 /*     public function get_jur(){
         $q=$this->db->query("select * from jurusan");
         return $q;
    }

      public function pindah($nama,$jur){
         $q=$this->db->query("update pendaftar set pil_2='$jur' where nama='$nama' ");
         return $q;
    }



    public function get_peserta(){
    	 $q=$this->db->query("select * from data_diri");
         return $q;
    }

     public function update_data_peserta($data,$id)
    {
            $this->db->where('no_pes', $id);
            $this->db->update('pendaftar', $data); 
    } 

    public function hapus_peserta($id){
        $query=$this->db->query("delete from pendaftar where no_pes='$id' ");
    }
*/

}