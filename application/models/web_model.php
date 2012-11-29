<?php
class Web_model extends CI_Model
	{
		function Web_model()
		{
			parent::__construct();
		}
		
		function lookup($keyword)
		{
		$query=$this->db->query("SELECT title from ((SELECT title from tbl_data) union (SELECT title from tbl_event)) as title where title like '%$keyword%'");
			return $query->result();
		}
		
		function Tampil_Event_Terbaru($batas,$ofset)
		{
			$query_event=$this->db->query("select * from tbl_event order by id DESC LIMIT $ofset,$batas");
			return $query_event;
		}
		
		function Pencarian_event($kata_kunci)
		{
			$quer_cari_e=$this->db->query("SELECT * from tbl_event left join tbl_user on tbl_event.id_penulis=tbl_user.id_user where content like '%$kata_kunci%'");
			return $quer_cari_e;
		}
		
		function Pencarian_artikel($kata_kunci)
		{
			$quer_cari_a=$this->db->query("SELECT * from tbl_artikel left join tbl_user on tbl_artikel.id_penulis=tbl_user.id_user where isi like '%$kata_kunci%'");
			return $quer_cari_a;
		}
		
		function Slide_Artikel($tipe,$kat,$batas)
		{
			$q=$this->db->query("SELECT * from tbl_artikel left join (tbl_kategori_artikel,tbl_user) on tbl_artikel.id_kategori=tbl_kategori_artikel.id_kat and tbl_artikel.id_penulis=tbl_user.id_user where tipe_artikel='$tipe' $kat order by id_artikel DESC LIMIT $batas");
			return $q;
		}
		function Menu_Atas()
		{
			$q=$this->db->query("SELECT * from tbl_menu where id_parent='0' and level='0'");
			return $q;
		}
		function Sub_Menu_Atas($id_parent,$level)
		{
			$q=$this->db->query("SELECT * from tbl_menu where id_parent='$id_parent' and level='$level'");
			return $q;
		}
		function Menu_Bawah()
		{
			$q=$this->db->query("SELECT * from tbl_menu where id_parent='0' and level=10");
			return $q;
		}
		function Tampil_Event($tipe,$limit)
		{
			$q=$this->db->query("SELECT * from tbl_event where type='$tipe' order by id DESC LIMIT $limit");
			return $q;
		}
		function Tampil_Polling()
		{
			$q=$this->db->query("select * from tbl_pollingsoal where status='Y'");
			return $q;
		}
		function Tampil_Jwb_Poll($id_soal)
		{
			$q=$this->db->query("select * from tbl_pollingjawaban where id_soal='$id_soal'");
			return $q;
		}
		function Detail_Event($id_pengumuman,$tipe)
		{
			$q=$this->db->query("select * from tbl_event left join tbl_user on tbl_event.id_penulis=tbl_user.id_user where id='$id_pengumuman' and type='$tipe' order by id DESC ");
			return $q;
		}
		function Detail_Artikel($id,$tipe)
		{
			$q=$this->db->query("select * from tbl_artikel left join tbl_kategori_artikel on tbl_artikel.id_kategori=tbl_kategori_artikel.id_kat where id_artikel='$id'");
			return $q;
		}
		function Data_Statis($id)
		{
			$q=$this->db->query("select * from tbl_data left join tbl_menu on tbl_data.data_id=tbl_menu.id where data_id='$id'");
			return $q;
		}
		function Update_Polling($id_poll)
		{
			$query_update=$this->db->query("update tbl_pollingjawaban set counter=counter+1 where id_jawaban='$id_poll'");
			return $query_update;
		}
		function Update_Pengunjung()
		{
			$query_update=$this->db->query("update tbl_data set content=content+1 where data_id='counter'");
			return $query_update;
		}
		function Insert_Guestbook($datainsert) 
		{
			$this->db->insert('tbl_guestbook',$datainsert);
		}
		function Counter_Pengunjung()
		{
			$q=$this->db->query("select * from tbl_data where data_id='counter'");
			return $q;
		}
		
		
		function Isi_Event($tipe,$limit,$ofset)
		{
			$q=$this->db->query("select * from tbl_event left join tbl_user on tbl_event.id_penulis=tbl_user.id_user where type='$tipe' order by id DESC LIMIT $ofset,$limit");
			return $q;
		}
		function Isi_Artikel($tipe,$join,$limit,$ofset)
		{
			$q=$this->db->query("select * from tbl_artikel $join where tipe_artikel='$tipe' order by id_artikel DESC LIMIT $ofset,$limit");
			return $q;
		}
		function Total_Isi($tabel,$tipe)
		{
			$q=$this->db->query("select * from $tabel where $tipe");
			return $q;
		}
		
		function Album_Galeri($limit,$ofset)
		{
			$q=$this->db->query("select * from tbl_album_galeri order by id_album DESC limit $ofset,$limit");
			return $q;
		}
		
		function Total_Album()
		{
			$q=$this->db->query("select * from tbl_album_galeri order by id_album DESC");
			return $q;
		}
		
		function Total_Galeri($id)
		{
			$q=$this->db->query("select * from tbl_galeri where id_album='$id'");
			return $q;
		}
		function Detail_Galeri($id_album,$offset,$limit)
		{
			$q=$this->db->query("select * from tbl_galeri left join tbl_album_galeri on tbl_galeri.id_album=tbl_album_galeri.id_album where tbl_galeri.id_album='$id_album' limit 
			$offset,$limit");
			return $q;
		}
		function Tampil_Galeri()
		{
			$q=$this->db->query("select * from tbl_galeri left join tbl_album_galeri on tbl_galeri.id_album=tbl_album_galeri.id_album order by id_foto DESC limit 8");
			return $q;
		}	
		
		function Berkas($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_media order by id_file DESC LIMIT $offset,$limit");
			return $q;
		}
		
		function Total_Berkas()
		{
			$q=$this->db->query("select * from tbl_media where file_type!='image' order by id_file DESC");
			return $q;
		}
	}
?>
