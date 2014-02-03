<?php
class M_hasil_tes extends CI_Model {


    function __construct()
    {
        parent::__construct();
        //get instance
        $this->CI = get_instance();
    }
  

    function get_nilai() {
        //pilih nama tabel
        $table_name = "v_ujian";
        $this->db->select('no_pes,nama,pilihan1,pilihan2,nilai_umum,nilai_agama,nilai_bahasa,nilai_essay')->from($table_name);
        $this->CI->flexigrid->build_query();        
        //Get contents
        $return['records'] = $this->db->get();        
        //Build count query
        $this->db->select('count(no_pes) as record_count')->from($table_name);
        $this->CI->flexigrid->build_query(FALSE);
        $record_count = $this->db->get();
        $row = $record_count->row();        
        //Get Record Count
        $return['record_count'] = $row->record_count;    
        //Return all
        return $return;
    }
    

    function input_nilai_ujian($dataarray)
    {
        for($i=1;$i<count($dataarray);$i++){
            $data = array(
                'no_pes'=>$dataarray[$i]['no_pes'],
                'nilai_umum'=>$dataarray[$i]['ujian_umum'],
                'nilai_agama'=>$dataarray[$i]['ujian_agama'],
                'nilai_bahasa'=>$dataarray[$i]['ujian_bahasa'],
                'nilai_essay'=>$dataarray[$i]['ujian_essay']
            );
            $q2=$this->db->query("select * from data_diri where no_pes='".$dataarray[$i]['no_pes']."' ");
            if($q2->num_rows >=1 ){
                $q=$this->db->query("select * from ujian where no_pes='".$dataarray[$i]['no_pes']."' ");
                    if ($q->num_rows() >= 1) {
                       $this->db->where('no_pes', $dataarray[$i]['no_pes']);
                       $hasil=$this->db->update('ujian', $data); 
                     }
                     else {
                        $hasil=$this->db->insert('ujian', $data);
                      }

                    if(!$hasil){
                        $i=count($dataarray);
                        $result="gagal";
                     }
                     else{
                        $result="sukses";
                     }
            }
            else {

            }                    
            
        }
        return $result;
    }

}