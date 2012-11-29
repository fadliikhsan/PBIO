<?php

class Web extends CI_Controller {

	function Web()
	{
		parent::__construct();
		$this->load->helper(array('form','url', 'text_helper','date'));
		$this->load->database();
		$this->load->library(array('Pagination','user_agent'));
		$this->load->model('Web_model');
		session_start();
	}
	
	function index()
	{
		$data=array();
		$data["menu"] 					= $this->Web_model->Menu_Atas();
		$data["counter_pengunjung"] 	= $this->Web_model->Counter_Pengunjung();
		setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24);
		if (!isset($_COOKIE["pengunjung"])) 
		{
			$this->Web_model->Update_Pengunjung();
		}
		$data["donlod"] 				= $this->Web_model->Berkas(0,3);
		$data["menu_bawah"] 			= $this->Web_model->Menu_Bawah();
		$data["agenda"] 				= $this->Web_model->Tampil_Event("agenda","5");
		$data["pengumuman"] 			= $this->Web_model->Tampil_Event("pengumuman","3");
		$data["slide_berita"] 			= $this->Web_model->Slide_Artikel("berita"," ","4");
		$data["slide_learning"] 		= $this->Web_model->Slide_Artikel("tutorial","","2");
		$data["cuplikan_galeri"] 		= $this->Web_model->Tampil_Galeri();
		$data["slide_kemahasiswaan"] 	= $this->Web_model->Slide_Artikel("berita","and id_kategori='2'","2");
		$data["slide_akademik"] 		= $this->Web_model->Slide_Artikel("berita","and id_kategori='1'","2");
		$data["slide_kegiatan"] 		= $this->Web_model->Slide_Artikel("berita","and id_kategori='5'","2");
		$data["browser"] 				= $this->agent->browser().' '.$this->agent->version();
		$data["os"] 					= $this->agent->platform();
		$data["soal_polling"] 			= $this->Web_model->Tampil_Polling();
		$soal_poll 						= $data["soal_polling"];
		foreach($soal_poll->result() as $soal)
			{
				$id_soal=$soal->id;
			}
		$data["jawaban_polling"] = $this->Web_model->Tampil_Jwb_Poll($id_soal);
		$this->load->view('web/bg_atas',$data);
		$this->load->view('web/bg_home',$data);
		$this->load->view('web/bg_kiri',$data);
		$this->load->view('web/isi_index',$data);
		$this->load->view('web/bg_kanan',$data);
		$this->load->view('web/bg_bawah');
	}	
	
	function data()
	{
		$id			='';
		if($this->uri->segment(3) === FALSE)
		{
			$id	= '';
		}
		else
		{
			$id	= $this->uri->segment(3);
		}
		$data						= array();
		$data["counter_pengunjung"]	= $this->Web_model->Counter_Pengunjung();
		setcookie("pengunjung","sudah berkunjung", time() + 900 * 24);
		if(!isset($_COOKIE["pengunjung"]))
		{
			$this->Web_model->Update_Pengunjung();
		}
		
		$data["donlod"] 				= $this->Web_model->Berkas(0,3);
		$data["menu"] 					= $this->Web_model->Menu_Atas();
		$data["menu_bawah"] 			= $this->Web_model->Menu_Bawah();
		$data["agenda"] 				= $this->Web_model->Tampil_Event("agenda","5");
		$data["pengumuman"] 			= $this->Web_model->Tampil_Event("pengumuman","3");
		$data["slide_berita"] 			= $this->Web_model->Slide_Artikel("berita"," ","4");
		$data["cuplikan_galeri"] 		= $this->Web_model->Tampil_Galeri();
		$data["slide_learning"] 		= $this->Web_model->Slide_Artikel("tutorial","and id_kategori='1'","2");
		$data["slide_kemahasiswaan"] 	= $this->Web_model->Slide_Artikel("berita","and id_kategori='2'","2");
		$data["slide_akademik"]		 	= $this->Web_model->Slide_Artikel("berita","and id_kategori='1'","2");
		$data["slide_kegiatan"] 		= $this->Web_model->Slide_Artikel("berita","and id_kategori='5'","2");
		$data["browser"] 				= $this->agent->browser().' '.$this->agent->version();
		$data["os"] 					= $this->agent->platform();
		$data["soal_polling"] 			= $this->Web_model->Tampil_Polling();
		$soal_poll 						= $data["soal_polling"];
		
		foreach($soal_poll->result() as $soal)
		{
				$id_soal=$soal->id;
		}
		
		$data["jawaban_polling"] 		= $this->Web_model->Tampil_Jwb_Poll($id_soal);
		$this->load->view('web/bg_atas',$data);
		$this->load->view('web/bg_kiri',$data);
		$data["detail"] 				= $this->Web_model->Data_Statis($id);
		if($id=="12")
		{
			$this->load->view('web/guest_book',$data);
		}
		
		else if($id=="6" or $id=="9")
		{
				$page				=$this->uri->segment(4);
				$limit_artikel		=3;
				$limit_event		=4;
				if(!$page):
					$ofset_artikel 	= 0;
					$ofset_event 	= 0;
				else:
					$ofset_artikel 	= $page;
					$ofset_event 	= $page;
				endif;
				
				if($id=="7")
				{
					$data["judul"] 		= "Agenda";
					$data["isi"] 		= $this->Web_model->Isi_Event("agenda",$limit_event,$ofset_event);
					$tot_hal 			= $this->Web_model->Total_Isi("tbl_event","type='agenda'");
					$config['per_page'] = $limit_event;
				}
				
				if($id=="8")
				{
					$data["judul"] 		= "Pengumuman";
					$data["isi"] 		= $this->Web_model->Isi_Event("pengumuman",$limit_event,$ofset_event);
					$tot_hal 			= $this->Web_model->Total_Isi("tbl_event","type='pengumuman'");
					$config['per_page'] = $limit_event;
				}
				
				else if($id=="6")
				{
					$data["judul"] 		= "Indexs Berita";
					$data["isi"] 		= $this->Web_model->Isi_Artikel("berita","left join tbl_kategori_artikel on tbl_artikel.id_kategori=tbl_kategori_artikel.id_kat",$limit_artikel,$ofset_artikel);
					$tot_hal 			= $this->Web_model->Total_Isi("tbl_artikel","tipe_artikel='berita'");
					$config['per_page'] = $limit_artikel;
				}
				
				else if($id=="9")
				{
					$data["judul"] 		= "Materi Tutorial";
					$data["isi"] 		= $this->Web_model->Isi_Artikel("tutorial","left join tbl_kategori_artikel on tbl_artikel.id_kategori=tbl_kategori_artikel.id_kat",$limit_artikel,$ofset_artikel);
					$tot_hal 			= $this->Web_model->Total_Isi("tbl_artikel","tipe_artikel='tutorial'");
					$config['per_page'] = $limit_artikel;
				}
				
					$config['base_url'] 		= base_url() . '/index.php/web/data/'.$id;
					$config['total_rows'] 		= $tot_hal->num_rows();
					$config['uri_segment'] 		= 4;
					$config['first_link'] 		= 'Awal';
					$config['last_link'] 		= 'Akhir';
					$config['next_link'] 		= 'Selanjutnya';
					$config['prev_link'] 		= 'Sebelumnya';
					$this->pagination->initialize($config);
					$data["paginator"] 			=$this->pagination->create_links();
					$this->load->view('web/daftar_artikel',$data);
		}
		
		else if($id=="7" or $id=="8")
		{
					$page=$this->uri->segment(4);
					$limit_artikel		=3;
					$limit_event		=4;
					if(!$page):
						$ofset_artikel 	= 0;
						$ofset_event 	= 0;
					else:
						$ofset_artikel 	= $page;
						$ofset_event 	= $page;
					endif;
					
					if($id=="7")
					{
						$data["judul"] 		= "Agenda";
						$data["isi"] 		= $this->Web_model->Isi_Event("agenda",$limit_event,$ofset_event);
						$tot_hal 			= $this->Web_model->Total_Isi("tbl_event","type='agenda'");
						$config['per_page'] = $limit_event;
					}
					if($id=="8")
					{
						$data["judul"] 		= "Pengumuman";
						$data["isi"] 		= $this->Web_model->Isi_Event("pengumuman",$limit_event,$ofset_event);
						$tot_hal 			= $this->Web_model->Total_Isi("tbl_event","type='pengumuman'");
						$config['per_page'] = $limit_event;
					}
					else if($id=="6")
					{
						$data["judul"] 		= "Indexs Berita";
						$data["isi"] 		= $this->Web_model->Isi_Artikel("berita","left join tbl_kategori_artikel on tbl_artikel.id_kategori=tbl_kategori_artikel.id_kat",$limit_artikel,
						$ofset_artikel);
						$tot_hal 			= $this->Web_model->Total_Isi("tbl_artikel","tipe_artikel='berita'");
						$config['per_page'] = $limit_artikel;
					}
					else if($id=="9")
					{
						$data["judul"] 		= "Materi Tutorial";
						$data["isi"] 		= $this->Web_model->Isi_Artikel("tutorial","left join tbl_kategori_artikel on tbl_artikel.id_kategori=tbl_kategori_artikel.id_kat",
						$limit_artikel,
						$ofset_artikel);
						$tot_hal 			= $this->Web_model->Total_Isi("tbl_artikel","tipe_artikel='tutorial'");
						$config['per_page'] = $limit_artikel;
					}
					
						$config['base_url'] 	= base_url() . '/index.php/web/data/'.$id;
						$config['total_rows'] 	= $tot_hal->num_rows();
						$config['uri_segment'] 	= 4;
						$config['first_link'] 	= 'Awal';
						$config['last_link'] 	= 'Akhir';
						$config['next_link'] 	= 'Selanjutnya';
						$config['prev_link'] 	= 'Sebelumnya';
						$this->pagination->initialize($config);
						$data["paginator"] =$this->pagination->create_links();
						$this->load->view('web/daftar_event',$data);
		}
		
		else if($id=="10")
		{
			$page		=$this->uri->segment(4);
			$limit		=9;
			if(!$page):
				$offset = 0;
			else:
				$offset = $page;
			endif;
			$data["album"] 				= $this->Web_model->Album_Galeri($limit,$offset);
			$tot_hal 					= $this->Web_model->Total_Album();
				$config['base_url'] 	= base_url() . '/index.php/web/data/'.$id.'/';
				$config['total_rows'] 	= $tot_hal->num_rows();
				$config['per_page'] 	= $limit;
				$config['uri_segment'] 	= 4;
				$config['first_link'] 	= 'Awal';
				$config['last_link'] 	= 'Akhir';
				$config['next_link'] 	= 'Selanjutnya';
				$config['prev_link'] 	= 'Sebelumnya';
				$this->pagination->initialize($config);
			$data["paginator"] 			= $this->pagination->create_links();
			$this->load->view('web/album_galeri',$data);
		}
		else if($id=="11")
		{
			$page		= $this->uri->segment(4);
			$limit		= 4;
			if(!$page):
				$offset = 0;
			else:
				$offset = $page;
			endif;
			$data["isi"] 				= $this->Web_model->Berkas($offset,$limit);
			$tot_hal 					= $this->Web_model->Total_Berkas();
				$config['base_url'] 	= base_url() . '/index.php/web/data/'.$id.'/';
				$config['total_rows'] 	= $tot_hal->num_rows();
				$config['per_page'] 	= $limit;
				$config['uri_segment'] 	= 4;
				$config['first_link'] 	= 'Awal';
				$config['last_link'] 	= 'Akhir';
				$config['next_link'] 	= 'Next';
				$config['prev_link'] 	= 'Previous';
				$this->pagination->initialize($config);
			$data["paginator"] 			= $this->pagination->create_links();
			$this->load->view('web/download',$data);
		}
		else if($id=="1.1" or $id=="1.2" or $id=="1.3" or $id=="1.5" or $id=="2.1" or $id=="2.2" or $id=="2.3" or $id=="3.1" or $id=="3.2" or $id=="4.1" or $id=="4.2" or $id=="4.3" or $id=="4.4" or $id=="5.2" or $id=="6.1")
		{
			$this->load->view('web/data_statis',$data);
		}
		else
		{
			if($id =="")
			{
				$this->load->view('web/data_kosong');
			}
			else
			{
				$this->load->view('web/data_kosong');	
			}
		}
		
		$this->load->view('web/bg_kanan',$data);
		$this->load->view('web/bg_bawah');
		
	}
	
	function lihathasil()
	{
		$data=array();
		$data["counter_pengunjung"] = $this->Web_model->Counter_Pengunjung();
		setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24);
		if (!isset($_COOKIE["pengunjung"])) {
			$this->Web_model->Update_Pengunjung();
		}
		$data["soal_polling"] = $this->Web_model->Tampil_Polling();
		$soal_poll = $data["soal_polling"];
		foreach($soal_poll->result() as $soal)
			{
				$id_soal=$soal->id;
			}
		$data["donlod"] = $this->Web_model->Berkas(0,3);
		$data["jawaban_polling"] = $this->Web_model->Tampil_Polling($id_soal);
		$data["menu"] = $this->Web_model->Menu_Atas();
		$data["menu_bawah"] = $this->Web_model->Menu_Bawah();
		$data["agenda"] = $this->Web_model->Tampil_Event("agenda","5");
		$data["pengumuman"] = $this->Web_model->Tampil_Event("pengumuman","4");
		$data["slide_learning"] = $this->Web_model->Slide_Artikel("tutorial","and id_kategori='1'","2");
		$data["slide_kemahasiswaan"] = $this->Web_model->Slide_Artikel("berita","and id_kategori='2'","2");
		$data["slide_akademik"] = $this->Web_model->Slide_Artikel("berita","and id_kategori='1'","2");
		$data["slide_kegiatan"] = $this->Web_model->Slide_Artikel("berita","and id_kategori='5'","2");
		$data["browser"] = $this->agent->browser().' '.$this->agent->version();
		$data["os"] = $this->agent->platform();
		$data["soal_polling"] = $this->Web_model->Tampil_Polling();
		$soal_poll = $data["soal_polling"];
		foreach($soal_poll->result() as $soal)
			{
				$id_soal=$soal->id;
			}
		$data["jawaban_polling"] = $this->Web_model->Tampil_Jwb_Poll($id_soal);
		$this->load->view('web/bg_atas',$data);
		$this->load->view('web/bg_kiri',$data);
		$this->load->view('web/hasil_polling',$data);
		$this->load->view('web/bg_kanan',$data);
		$this->load->view('web/bg_bawah_other');
	}
	
	function hasilpolling()
	{
      	$data=array();
		$data["counter_pengunjung"] = $this->Web_model->Counter_Pengunjung();
		setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24);
		if (!isset($_COOKIE["pengunjung"])) {
			$this->Web_model->Update_Pengunjung();
		}
		$pilih=$this->input->post('polling');
		$id_soal=$this->input->post('id_soal');
		setcookie("poling", "sudah poling", time() + 3600 * 24);
		if (isset($_COOKIE["poling"])) {
   		?>
			<script type="text/javascript">
				alert("Maaf, anda sudah mengisi polling ini!!! Setiap hari, hanya bisa mengisi satu kali. Silahkan vote kembali besok.");
			</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/web/lihathasil'>";
 		}
 		else{
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		$this->Web_model->Update_Polling($pilih);
		$data["soal_polling"] = $this->Web_model->Tampil_Polling();
		$soal_poll = $data["soal_polling"];
		foreach($soal_poll->result() as $soal)
			{
				$id_soal=$soal->id;
			}
		$data["jawaban_polling"] = $this->Web_model->Tampil_Polling($id_soal);
		
		$data["donlod"] = $this->Web_model->Berkas(0,3);
		$data["menu"] = $this->Web_model->Menu_Atas();
		$data["menu_bawah"] = $this->Web_model->Menu_Bawah();
		$data["agenda"] = $this->Web_model->Tampil_Event("agenda","5");
		$data["pengumuman"] = $this->Web_model->Tampil_Event("pengumuman","4");
		$data["slide_learning"] = $this->Web_model->Slide_Artikel("tutorial","and id_kategori='1'","2");
		$data["slide_kemahasiswaan"] = $this->Web_model->Slide_Artikel("berita","and id_kategori='2'","2");
		$data["slide_akademik"] = $this->Web_model->Slide_Artikel("berita","and id_kategori='1'","2");
		$data["slide_kegiatan"] = $this->Web_model->Slide_Artikel("berita","and id_kategori='5'","2");
		$data["browser"] = $this->agent->browser().' '.$this->agent->version();
		$data["os"] = $this->agent->platform();
		$data["soal_polling"] = $this->Web_model->Tampil_Polling();
		$soal_poll = $data["soal_polling"];
		foreach($soal_poll->result() as $soal)
			{
				$id_soal=$soal->id;
			}
		$data["jawaban_polling"] = $this->Web_model->Tampil_Jwb_Poll($id_soal);
		$this->load->view('web/bg_atas',$data);
		$this->load->view('web/bg_kiri',$data);
		$this->load->view('web/hasil_polling',$data);
		$this->load->view('web/bg_kanan',$data);
		$this->load->view('web/bg_bawah_other');
		}
		

	}
	
	function detberita()
	{
		$id					= '';		
		if ($this->uri->segment(4) === FALSE)
		{
    			$id			= '';
		}
		else
		{
    			$id 		= $this->uri->segment(4);
		}
		$tipe				= '';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$tipe		= '';
		}
		else
		{
    			$itipe 		= $this->uri->segment(3);
		}
		$data				= array();
		$data["counter_pengunjung"] 	= $this->Web_model->Counter_Pengunjung();
		setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24);
		if (!isset($_COOKIE["pengunjung"])) {
			$this->Web_model->Update_Pengunjung();
		}
		$data["donlod"] 				= $this->Web_model->Berkas(0,3);
		$data["menu"] 					= $this->Web_model->Menu_Atas();
		$data["menu_bawah"] 			= $this->Web_model->Menu_Bawah();
		$data["agenda"] 				= $this->Web_model->Tampil_Event("agenda","5");
		$data["pengumuman"] 			= $this->Web_model->Tampil_Event("pengumuman","4");
		$data["detail"] 				= $this->Web_model->Detail_Artikel($id,$tipe);
		$data["cuplikan_galeri"] 		= $this->Web_model->Tampil_Galeri();
		$data["slide_learning"] 		= $this->Web_model->Slide_Artikel("tutorial","and id_kategori='1'","2");
		$data["slide_kemahasiswaan"] 	= $this->Web_model->Slide_Artikel("berita","and id_kategori='2'","2");
		$data["slide_akademik"] 		= $this->Web_model->Slide_Artikel("berita","and id_kategori='1'","2");
		$data["slide_kegiatan"] 		= $this->Web_model->Slide_Artikel("berita","and id_kategori='5'","2");
		$data["browser"] 				= $this->agent->browser().' '.$this->agent->version();
		$data["os"] 					= $this->agent->platform();
		$data["soal_polling"] 			= $this->Web_model->Tampil_Polling();
		$soal_poll 						= $data["soal_polling"];
		foreach($soal_poll->result() as $soal)
			{
				$id_soal				= $soal->id;
			}
		$data["jawaban_polling"] 		= $this->Web_model->Tampil_Jwb_Poll($id_soal);
			$this->load->view('web/bg_atas',$data);
			$this->load->view('web/bg_kiri',$data);
			$this->load->view('web/detail_berita',$data);
			$this->load->view('web/bg_kanan',$data);
			$this->load->view('web/bg_bawah');
	}
	
	function lookup()
	{
        // process posted form data (the requested items like province)
        $keyword 			= $this->input->post('term');
        $data['response'] 	= 'false'; //Set default response
        $query				= $this->Web_model->lookup($keyword); //Search DB
        if( ! empty($query) )
        {
            $data['response'] 	= 'true'; //Set response
            $data['message'] 	= array(); //Create array
            foreach( $query as $row )
            {
                $data['message'][] = array
				(
                    
                    'value' =>$row->title,
                                        ''
                );  //Add a row to array
            }
        }
        if('IS_AJAX')
        {
            echo json_encode($data); //echo json string if ajax request
 
        }
        else
        {
            $this->load->view('web/hasil_pencarian',$data); //Load html view of search results
        }
    }
	
	function pencarian()
	{
		$data						= array();
		$data["counter_pengunjung"]	= $this->Web_model->Counter_Pengunjung();
		setcookie("pengunjung","sudah berkunjung", time() + 900 * 24);
		if(!isset($_COOKIE["pengunjung"]))
		{
			$this->Web_model->Update_Pengunjung();
		}
		
		$data["donlod"] 				= $this->Web_model->Berkas(0,3);
		$data["menu"] 					= $this->Web_model->Menu_Atas();
		$data["menu_bawah"] 			= $this->Web_model->Menu_Bawah();
		$data["agenda"] 				= $this->Web_model->Tampil_Event("agenda","5");
		$data["pengumuman"] 			= $this->Web_model->Tampil_Event("pengumuman","3");
		$data["slide_berita"] 			= $this->Web_model->Slide_Artikel("berita"," ","4");
		$data["cuplikan_galeri"] 		= $this->Web_model->Tampil_Galeri();
		$data["slide_learning"] 		= $this->Web_model->Slide_Artikel("tutorial","and id_kategori='1'","2");
		$data["slide_kemahasiswaan"] 	= $this->Web_model->Slide_Artikel("berita","and id_kategori='2'","2");
		$data["slide_akademik"]		 	= $this->Web_model->Slide_Artikel("berita","and id_kategori='1'","2");
		$data["slide_kegiatan"] 		= $this->Web_model->Slide_Artikel("berita","and id_kategori='5'","2");
		$data["browser"] 				= $this->agent->browser().' '.$this->agent->version();
		$data["os"] 					= $this->agent->platform();
		$data["soal_polling"] 			= $this->Web_model->Tampil_Polling();
		$soal_poll 						= $data["soal_polling"];
		
		foreach($soal_poll->result() as $soal)
		{
				$id_soal=$soal->id;
		}
		
		$data["jawaban_polling"] 		= $this->Web_model->Tampil_Jwb_Poll($id_soal);
		
		
		$kata	= $this->input->post("cari_sesuatu");
		$tabel	= $this->input->post("pencarian");
		$this->load->model('Web_model');
		$limit_agenda	= 5;
		$offset_agenda 	= 0;
		
		
		$data["pilihan"] 			= $tabel;
		$data["kata"] 				= $kata;
		if ($tabel == 'tbl_event')
		{
			$data["hasil"] 			= $this->Web_model->Pencarian_event($kata);
		}
		else
		{
			$data["hasil"] 			= $this->Web_model->Pencarian_artikel($kata);
		}
		$data["jumlah"] 			= $data["hasil"]->num_rows;
		
		
		$this->load->view('web/bg_atas',$data);
		$this->load->view('web/bg_kiri',$data);
		$this->load->view('web/hasil_pencarian',$data);
		$this->load->view('web/bg_kanan',$data);
		$this->load->view('web/bg_bawah');
		
	}
	
	function galeri()
	{
		$id			='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id	='';
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data		= array();
		$data["counter_pengunjung"] 	= $this->Web_model->Counter_Pengunjung();
		setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24);
		if (!isset($_COOKIE["pengunjung"])) 
		{
			$this->Web_model->Update_Pengunjung();
		}
		$data["soal_polling"] 				= $this->Web_model->Tampil_Polling();
		$soal_poll 							= $data["soal_polling"];
		foreach($soal_poll->result() as $soal)
			{
				$id_soal=$soal->id;
			}
				$data["donlod"] 			= $this->Web_model->Berkas(0,3);
				$data["jawaban_polling"]	= $this->Web_model->Tampil_Polling($id_soal);
				$data["menu"] 				= $this->Web_model->Menu_Atas();
				$data["menu_bawah"] 		= $this->Web_model->Menu_Bawah();
				$data["agenda"] 			= $this->Web_model->Tampil_Event("agenda","5");
				$data["pengumuman"] 		= $this->Web_model->Tampil_Event("pengumuman","4");
				$data["slide_learning"] 	= $this->Web_model->Slide_Artikel("tutorial","and id_kategori='1'","2");
				$data["slide_kemahasiswaan"]= $this->Web_model->Slide_Artikel("berita","and id_kategori='2'","2");
				$data["slide_akademik"] 	= $this->Web_model->Slide_Artikel("berita","and id_kategori='1'","2");
				$data["slide_kegiatan"] 	= $this->Web_model->Slide_Artikel("berita","and id_kategori='5'","2");
				$data["browser"] 			= $this->agent->browser().' '.$this->agent->version();
				$data["os"] 				= $this->agent->platform();
				$data["soal_polling"] 		= $this->Web_model->Tampil_Polling();
				$soal_poll 					= $data["soal_polling"];
				foreach($soal_poll->result() as $soal)
					{
						$id_soal=$soal->id;
					}
				$data["jawaban_polling"] 	= $this->Web_model->Tampil_Jwb_Poll($id_soal);
				
				$page						= $this->uri->segment(4);
				$limit						= 12;
				if(!$page):
					$offset = 0;
				else:
					$offset = $page;
				endif;
				$tot_hal 							= $this->Web_model->Total_Galeri($id);
				$data["detail_galeri"] 				= $this->Web_model->Detail_Galeri($id,$offset,$limit);
				$data["cuplikan_galeri"] 			= $this->Web_model->Tampil_Galeri();
					$config['base_url'] 			= base_url() . '/index.php/web/galeri/'.$id.'/';
					$config['total_rows'] 			= $tot_hal->num_rows();
					$config['per_page'] 			= $limit;
					$config['uri_segment'] 			= 4;
					$config['first_link'] 			= 'Awal';
					$config['last_link'] 			= 'Akhir';
					$config['next_link'] 			= 'Selanjutnya';
					$config['prev_link'] 			= 'Sebelumnya';
						$this->pagination->initialize($config);
				$data["paginator"] 					= $this->pagination->create_links();
				
					$this->load->view('web/bg_atas',$data);
					$this->load->view('web/bg_kiri',$data);
					$this->load->view('web/detail_galeri',$data);
					$this->load->view('web/bg_kanan',$data);
					$this->load->view('web/bg_bawah');
	}
	
	function simpanguestbook()
	{
		$nl=$this->input->post('nama');
		$nama=strip_tags($nl);
		$el=$this->input->post('email');
		$email=strip_tags($el);
		$pl=$this->input->post('pesan');
		$pesan=strip_tags($pl);
		if(empty($nama) || empty($email) || empty($pesan))
		{
			?>
				<script type="text/javascript">
					alert("Field belum lengkap...!!!");
				</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/web/data/12'>";
		}
		else{
			$datestring = "%d-%m-%Y | %h:%i %a";
			$time = time();
			$datainsert = array();	
				$datainsert['nama'] = $nama;
				$datainsert['email'] = $email;
				$datainsert['pesan'] = $pesan;
				$datainsert['status'] = "N";
				$datainsert['posted_date'] = mdate($datestring, $time);
		   $this->Web_model->Insert_Guestbook($datainsert);
			?>
				<script type="text/javascript">
					alert("Terima kasih atas kunjungan dan pesan dari anda.");
				</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
		}
	}
	
//==========================================Memakai Highslide Javascript===========================================
	function detagenda()
	{
		$id_pengumuman='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_pengumuman='';
		}
		else
		{
    			$id_pengumuman = $this->uri->segment(3);
		}
		$data['detail']=$this->Web_model->Detail_Event($id_pengumuman,"agenda");
		$this->load->view('web/detail_agenda',$data);
	}
	function detpengumuman()
	{
		$id_pengumuman='';		
		if ($this->uri->segment(3) === FALSE)
		{
    			$id_pengumuman='';
		}
		else
		{
    			$id_pengumuman = $this->uri->segment(3);
		}
		$data['detail']=$this->Web_model->Detail_Event($id_pengumuman,"pengumuman");
		$this->load->view('web/detail_pengumuman',$data);
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */