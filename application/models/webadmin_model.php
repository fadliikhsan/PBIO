<?php
class Webadmin_model extends CI_Model
	{
		function Webadmin_model()
		{
			parent::__construct();
		}
		
		function Data_Login($user,$pass)
		{
			$user_bersih=mysql_real_escape_string($user);
			$pass_bersih=mysql_real_escape_string($pass);
			$query=$this->db->query("select * from tbl_user where username='$user_bersih' and pass=password('$pass_bersih')");
			return $query;
		}
		
		function Update_Password($user,$pwd)
		{
			$this->db->query("update tbl_user set pass=PASSWORD('$pwd') where username='$user'");
		}
		
		private function reindex($tablename, $id_name) {
			$query = $this->db->query("SELECT IFNULL((MAX(".$id_name.")+1),1) As id FROM `".$tablename."`");
			foreach($query->result_array() as $row) {
				$max = $row['id'];			
			}
			$this->db->query('ALTER TABLE `'.$tablename.'` AUTO_INCREMENT ='.$max.';');
		}
		
		function Artikel($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_artikel left join tbl_user on tbl_artikel.id_penulis=tbl_user.id_user order by id_artikel DESC LIMIT $offset,$limit");
			return $q;
		}
		
		function Event($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_event left join tbl_user on tbl_event.id_penulis=tbl_user.id_user order by id DESC LIMIT $offset,$limit");
			return $q;
		}
		
		function Total_Data($tabel)
		{
			$q=$this->db->query("select * from $tabel");
			return $q;
		}
		

		function Total_Data_berita()
		{
			$qdber=$this->db->query("select * from tbl_media");
			return $qdber;
		}	
			
		function getDataFile() 
		{
			$qdbe=$this->db->query("select * from tbl_media");
			return $qdbe;
		}
		
		function Simpan_Gambar($datainsert)
		{
			$this->db->insert('tbl_media',$datainsert);
		}
		
		function Hapus_Media($id)
		{
			$this->db->where('id_file',$id );
			$this->db->delete('tbl_media');
		}
		
		function Pilih_Kategori($q)
		{
			$query=$this->db->query("select * from tbl_kategori_artikel where type='$q'");
			return $query;
		}
		
		function Semua_Kategori()
		{
			$query=$this->db->query("select * from tbl_kategori_artikel");
			return $query;
		}
		
		function Update_Content($tabel,$isi,$seleksi)
		{
			$this->db->where($seleksi,$isi[$seleksi]);
			$this->db->update($tabel,$isi);
		}
		
		function List_Kategori($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_kategori_artikel order by nama_kat DESC LIMIT $offset,$limit");
			return $q;
		}
		
		function Simpan_Artikel($data)
		{
			$s=$this->db->insert('tbl_artikel',$data);
			return $s;
		}
		
		function Simpan_Event($data)
		{
			$s=$this->db->insert('tbl_event',$data);
			return $s;
		}
		
		function Simpan_Kategori($data)
		{
			$s=$this->db->insert('tbl_kategori_artikel',$data);
			return $s;
		}
		
		function Delete_Content($id,$seleksi,$tabel)
		{
			$this->db->where($seleksi,$id);
			$this->db->delete($tabel);
		}
		
		function Edit_Content($tabel,$seleksi)
		{
			$query=$this->db->query("select * from $tabel where $seleksi");
			return $query;
		}
		
		function Data_Statis($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_data left join tbl_menu on tbl_data.data_id=tbl_menu.id where tbl_data.data_id!='counter' order by tbl_data.data_id ASC LIMIT $offset,$limit");
			return $q;
		}
		
		function Menu_Statis()
		{
			$q=$this->db->query("select * from tbl_menu where level='1' order by id ASC");
			return $q;
		}	
		
		function Simpan_Data_Statis($data)
		{
			$s=$this->db->insert('tbl_data',$data);
			return $s;
		}
		
		function Polling($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_pollingsoal order by id DESC LIMIT $offset,$limit");
			return $q;
		}
		
		function Jawaban_Polling($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_pollingjawaban left join tbl_pollingsoal on tbl_pollingjawaban.id_soal=tbl_pollingsoal.id order by id_jawaban DESC LIMIT $offset,$limit");
			return $q;
		}		
		
		function In_Polling($tabel,$data)
		{
			$s=$this->db->insert($tabel,$data);
			return $s;
		}
		
		function Soal_Poll()
		{
			$q=$this->db->query("select * from tbl_pollingsoal");
			return $q;
		}
		
		function Album_Galeri($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_album_galeri order by id_album DESC LIMIT $offset,$limit");
			return $q;
		}
		
		function Foto($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_galeri left join tbl_album_galeri on tbl_galeri.id_album=tbl_album_galeri.id_album order by id_foto DESC LIMIT $offset,$limit");
			return $q;
		}
		
		function Semua_Album()
		{
			$q=$this->db->query("select * from tbl_album_galeri");
			return $q;
		}
		
		function Semua_Foto()
		{
			$q=$this->db->query("select * from tbl_galeri");
			return $q;
		}
		
		function Daftar_File($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_media where file_type!='image' order by id_file DESC LIMIT $offset,$limit");
			return $q;
		}
		
		function Guestbook($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_guestbook order by id DESC LIMIT $offset,$limit");
			return $q;
		}
		
		
}
?>		