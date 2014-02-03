<?php
class M_seleksi extends CI_Model {
	
	function __construct()
    {
        parent::__construct();
        //get instance
        $this->CI = get_instance();
    }
	
	function get_seleksi() {
		//pilih nama tabel
		$table_name = "seleksi";
		$this->db->select('id_seleksi,nama_seleksi')->from($table_name);
		$this->CI->flexigrid->build_query();
		
		//Get contents
		$return['records'] = $this->db->get();
		
		//Build count query
		$this->db->select('count(id_seleksi) as record_count')->from($table_name);
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		
		//Get Record Count
		$return['record_count'] = $row->record_count;
	
		//Return all
		return $return;
	}

    function reset(){
        $this->db->query("update pendaftar set lulus='tidak' ");
        $this->db->query("truncate kelulusan ");
        $this->db->query("update jurusan set terisi='0' ");
    }

    function get_terisi($id){
        $q=$this->db->query("select * from jurusan where kode_jurusan=$id ");
        foreach ($q->result() as $k) {
            
        }

        return $k->terisi;
    }

    function reset1($id){
    	$this->db->query("update pendaftar set lulus='tidak' where pil_1='$id' and lulus='lulus_pil_1'");
    	$this->db->query("delete from kelulusan where kode_jurusan='$id' and keterangan='pil_1' ");
        $q=$this->db->query("select * from kelulusan where kode_jurusan='$id' and (keterangan='pil_2' or  keterangan='pil_3') ");
        $q2=$this->db->query("select * from jurusan where kode_jurusan='$id' ");
        foreach ($q2->result() as $hsl) {
            # code...
        }
        $kuota=$hsl->kuota;
        $jml=$q->num_rows();
        if($jml>0)
            $terisi=$kuota-$jml;
        else
            $terisi=0;
    	$this->db->query("update jurusan set terisi='$terisi' where kode_jurusan='$id' ");
    }

    function reset2($id){
        $this->db->query("update pendaftar set lulus='tidak' where pil_2='$id' and lulus='lulus_pil_2'");
        $this->db->query("delete from kelulusan where kode_jurusan='$id' and keterangan='pil_2' ");
        $q=$this->db->query("select * from kelulusan where kode_jurusan='$id' and (keterangan='pil_1' or  keterangan='pil_3') ");
        $q2=$this->db->query("select * from jurusan where kode_jurusan='$id' ");
        foreach ($q2->result() as $hsl) {
            # code...
        }
        $kuota=$hsl->kuota;
        $jml=$q->num_rows();
        if($jml>0)
            $terisi=$kuota-$jml;
        else
            $terisi=0;
        $this->db->query("update jurusan set terisi='$terisi' where kode_jurusan='$id' ");
    }

    function do_seleksi_sains($pil_1,$kuota){
    	$q=$this->db->query("SELECT * FROM v_tahap1 WHERE pil_1='$pil_1' and program like '%ipa%' and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' order by kumulatif desc,nilai_umum desc,nilai_bahasa desc,nilai_agama desc  limit $kuota ");
        return $q;
    }

    function do_seleksi_bahasa($pil_1,$kuota){
    	$q=$this->db->query("SELECT * FROM v_tahap1 WHERE pil_1='$pil_1' and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' order by kumulatif desc,nilai_bahasa  desc ,nilai_umum desc,nilai_agama desc limit $kuota ");
        return $q;
    }

      function do_seleksi_bahasa2($pil_2,$kuota){
        $q=$this->db->query("SELECT * FROM v_tahap1 WHERE pil_2='$pil_2' and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' order by kumulatif desc,nilai_bahasa  desc ,nilai_umum desc,nilai_agama desc limit $kuota ");
        return $q;
    }

      function do_seleksi($pil_1,$kuota){
    	$q=$this->db->query("SELECT * FROM v_tahap1 WHERE pil_1='$pil_1' and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' order by kumulatif desc,nilai_agama desc,nilai_bahasa desc,nilai_umum desc limit $kuota ");
        return $q;
    }

      function do_seleksi_sains2($pil_2,$kuota){
    	$q=$this->db->query("SELECT * FROM v_tahap1 WHERE pil_2='$pil_2' and program='ipa' and status='tidak' and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' order by kumulatif desc,nilai_umum desc,nilai_bahasa desc,nilai_agama desc limit $kuota ");
        return $q;
    }

      function do_seleksi_sains3($kuota){
        $q=$this->db->query("SELECT * FROM v_tahap1 WHERE  program='ipa' and status='tidak' and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' order by kumulatif desc,nilai_umum desc,nilai_bahasa desc,nilai_agama desc limit $kuota ");
        return $q;
    }

    function do_seleksi_bahasa3($kuota){
    	$q=$this->db->query("SELECT * FROM v_tahap1 WHERE status='tidak' and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' order by kumulatif desc,nilai_bahasa  desc,nilai_umum desc,nilai_agama desc limit $kuota ");
        return $q;
    }

       function do_seleksi2($pil_2,$kuota){
        $q=$this->db->query("SELECT * FROM v_tahap1 WHERE status='tidak' and pil_2='$pil_2' and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' order by kumulatif desc,nilai_agama desc,nilai_bahasa desc,nilai_umum desc limit $kuota ");
        return $q;
    }

      function do_seleksi3($kuota){
    	$q=$this->db->query("SELECT * FROM v_tahap1 WHERE  status='tidak' and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' order by kumulatif desc,nilai_agama desc,nilai_bahasa desc,nilai_umum desc limit $kuota ");
        return $q;
    }

    function set_terisi($id){
        $q=$this->db->query("select * from jurusan where kode_jurusan='$id' ");
        foreach ($q->result() as $h) {
        	# code...
        }
        $sekarang=$h->terisi;
        $terisi=($sekarang + 1);
        $q2=$this->db->query("update jurusan set terisi='$terisi' where kode_jurusan='$id' ");
        return $q2;
    }
    
    function set_seleksi($id){
        $q=$this->db->query("update jurusan set seleksi='sudah' where kode_jurusan='$id' ");
        return $q;
    }

       function set_seleksi_all(){
        $q=$this->db->query("update jurusan set seleksi='sudah' ");
        return $q;
    }

      function set_seleksi_belum(){
        $q=$this->db->query("update jurusan set seleksi='belum' ");
        return $q;
    }

    function unset_terisi($id){
        $q=$this->db->query("select * from jurusan where kode_jurusan='$id' ");
        foreach ($q->result() as $h) {
            # code...
        }
        $sekarang=$h->terisi;
        $terisi=($sekarang - 1);
        $q2=$this->db->query("update jurusan set terisi='$terisi' where kode_jurusan='$id' ");
        return $q2;
    }

    function set_lulus1($id){
    	$q=$this->db->query("update pendaftar set lulus='lulus_pil_1' where no_pes='$id' ");
    	return $q;
    }

    function set_lulus2($id){
        $q=$this->db->query("update pendaftar set lulus='lulus_pil_2' where no_pes='$id' ");
        return $q;
    }

     function set_lulus3($id){
        $q=$this->db->query("update pendaftar set lulus='lulus_pil_3' where no_pes='$id' ");
        return $q;
    }

 

     function set_tidak_lulus($id){
        $q=$this->db->query("update pendaftar set lulus='tidak' where no_pes='$id' ");
        return $q;
    }

    function kelulusan($id,$jur,$ket){
    	$data=array(
    		'no_pes'=>$id,
    		'kode_jurusan'=>$jur,
    		'keterangan'=>$ket,
    		);
        $q=$this->db->query("select * from kelulusan where no_pes='".$id."' ");
         if ($q->num_rows() >= 1) {
                       $this->db->where('no_pes', $id);
                       $this->db->update('kelulusan', $data); 
            }
             else {
                        $this->db->insert('kelulusan',$data);
              }
        	
      

    }

    function hapus_kelulusan($id){
        $q=$this->db->query("delete from kelulusan where no_pes='$id'");
        return $q;
    }

    function cek_kuota($id){
        $q=$this->db->query("select * from jurusan where kode_jurusan='$id' ");
        foreach ($q->result() as $h) {
            # code...
        }
        $terisi=(int)$h->terisi;
        $kuota=(int)$h->kuota;
        if(($terisi)<($kuota)){            
            $status="kosong";
            return $status;
        }
        else{
            $status="penuh";
            return $status;
        }
    }

     function cek_kosong($id){
        $q=$this->db->query("select * from jurusan where kode_jurusan='$id' ");
        foreach ($q->result() as $h) {
            # code...
        }

        if($h->terisi==0)
            return false;
        else
            return true;
    }

    function cek_pes($id){
        $q=$this->db->query("select * from kelulusan where no_pes='$id'");
        if($q->num_rows() >= 1){
            return true;
         }
         else {
            return false;
         }
    
    }

   function get_pendaftar($id){
     $q=$this->db->query("select * from jurusan where kode_jurusan='$id' ");
     foreach ($q->result() as $h) {
         # code...
     }
        if(($h->kode_fak=='2') || ($id=='205') || ($id=='206') || ($id=='207') || ($id=='208')){
             $q=$this->db->query("select * from v_tahap1 where (pil_1='$id') and program='ipa' and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' order by kumulatif desc,nilai_umum desc,nilai_bahasa desc,nilai_agama desc ");
         }
          else if(($id=='203') || ($id=='204') || ($id=='502') || ($id=='503') || ($id=='504')){
              $q=$this->db->query("select * from v_tahap1 where (pil_1='$id') and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' order by kumulatif desc,nilai_bahasa desc,nilai_umum desc,nilai_agama desc");
         }
           else{
               $q=$this->db->query("select * from v_tahap1 where (pil_1='$id') and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' order by kumulatif,nilai_agama desc,nilai_umum desc,nilai_bahasa desc");
         }
        
        return $q;
    }

     function get_pendaftar2($id){
        $q=$this->db->query("select * from jurusan where kode_jurusan='$id' ");
        foreach ($q->result() as $h) {
         # code...
        }
        if(($h->kode_fak=='2') || ($id=='205') || ($id=='206') || ($id=='207') || ($id=='208')){
             $q=$this->db->query("select * from v_tahap1 where (pil_2='$id') and program='ipa' and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' and status!='lulus_pil_1' order by kumulatif desc,nilai_umum desc,nilai_bahasa desc,nilai_agama desc");
         }
          else if(($id=='203') and ($id=='204') and ($id=='502') and ($id=='503') and ($id=='504')){
              $q=$this->db->query("select * from v_tahap1 where (pil_2='$id') and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' and status!='lulus_pil_1' order by kumulatif desc,nilai_bahasa desc,nilai_umum desc,nilai_agama desc");
         }
           else{
               $q=$this->db->query("select * from v_tahap1 where (pil_2='$id') and ujian_agama='Y' and ujian_umum='Y' and ujian_bahasa='Y' and status!='lulus_pil_1' order by kumulatif,nilai_agama desc,nilai_umum desc,nilai_bahasa desc");
         }
        
        return $q;
    }

         function get_pendaftar3($id){
        $q=$this->db->query("select * from  v_kelulusan where kode_jurusan='$id' order by no_pes desc ");
   
        return $q;
    }

     function get_jur($id){
        $q=$this->db->query("select * from jurusan where kode_jurusan='$id' ");
        return $q;
    }

    function get_jur_all(){
        $q=$this->db->query("select * from jurusan ");
        return $q;
    }

     function get_jur_all2(){
        $q=$this->db->query("select * from jurusan where terisi<kuota");
        return $q;
    }
   
	function hapus($id) {
		 $this->db->query("DELETE FROM seleksi where id_seleksi='".$id."'");
    }

	function get_seleksi2(){
		$query=$this->db->query("select * from seleksi");
		return $query;
	}

	function seleksi($id){
	    $query=$this->db->query("select * from seleksi where id_seleksi='$id' ");
		return $query;	
	}

	function simpan($data){
		$this->db->insert('seleksi',$data);
	}

	function get_jurusan(){
		$q=$this->db->query('select * from v_jml_pendaftar');
		return $q;
	}
    
    
    function get_jur_selected($id){
        $q=$this->db->query("select * from jurusan where kode_jurusan='$id'");
        return $q;
    }

	function get_jurusan2(){
		$q=$this->db->query('select * from jurusan where terisi<kuota');
		return $q;
	}

    function data_lulus(){
            $q=$this->db->query('select * from v_kelulusan order by kode_jurusan asc');
        return $q;
    }

     function data_tidak(){
            $q=$this->db->query("select no_pes,nama,pil_1,pil_2,tampil_pilihan1(no_pes) as pilihan1,tampil_pilihan2(no_pes) as pilihan2 from pendaftar where lulus='tidak'");
        return $q;
    }

    function sudah_seleksi($no_pes){

        $q=$this->db->query("select * from v_kelulusan where no_pes=$no_pes ");
        $jml=$q->num_rows();
        if($jml > 0){
           $seleksi="sudah";
           return $seleksi;
        }
        else{
           $seleksi="belum";
           return $seleksi;
        }
    }

	
}
?>