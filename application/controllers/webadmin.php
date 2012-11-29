<?php
class Webadmin extends CI_Controller {
	var $gallerypath;
	var $gallerypath_ori;
	function Webadmin()
	{
		parent::__construct();
		session_start();
		$this->load->helper(array('form','url', 'text_helper','date'));
		$this->load->database();
		$this->load->library(array('Pagination','image_lib'));
		$this->load->model('Webadmin_model');
		$this->gallerypath = realpath(APPPATH . '../application/views/web/galeri/');
		$this->gallerypath_ori = base_url().'system/application/views/web/galeri/';
	}

	function loginpanel()
	{
		$data		= array();
		$session	= isset($_SESSION['username_belajar'])? $_SESSION['username_belajar']:'';
		if($session!='')
		{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin'>";
		}
		else
		{
			$this->load->view('webadmin/bg_login');
		}	
	}
	
	function login()
	{
		$username	= $this->input->post('username');
		$pwd		= $this->input->post('password');
		$hasil		= $this->Webadmin_model->Data_Login($username,$pwd);
		if(count($hasil->result_array())>0)
		{
			foreach($hasil->result() as $items)
			{
				$session_username	= $items->username."|".$items->nama."|".$items->status."|".$items->id_user;
				$tanda				= $items->status;
			}
			$_SESSION['username_belajar'] = $session_username;
			if($tanda = "administrator")
			{
				echo"<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin'>";
			}
			else
			{
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript">
			alert("Username atau Password Yang Anda Masukkan Salah..!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function index()
	{
		$data			= array();
		$datestring		= "Login : %d-%m-%Y pukul %h:%i %a";
		$time			= time();
		$data["tanggal"]= mdate($datestring,$time);
		$session		= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data['username']	= $pecah[0];
			$data['nama']		= $pecah[1];
			$data['status']		= $pecah[2];
			$data['scriptmce']	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$this->load->view('webadmin/bg_atas',$data);
				$this->load->view('webadmin/bg_menu');
				$this->load->view('webadmin/isi_index',$data);
				$this->load->view('webadmin/bg_bawah');
			}
			else
			{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
		?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\n Anda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
		
	}
	
	
	function logout()
	{
		session_destroy();
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
	}
	
	function artikel()
	{
		$page			= $this->uri->segment(3);
		$limit			= 10;
		if(!$page):
			$offset	= 0;
		else:
			$offset = $page;
		endif;
		$data			= array();
		$datestring		= "Login : %d-%m-%Y pukul %h:%i %a";
		$time			= time();
		$data["tanggal"]= mdate($datestring,$time);
		$session		= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data["type"]		= "Artikel";
			$data["page"]		= $page;
			$data['username']	= $pecah[0];
			$data['nama']		= $pecah[1];
			$data['status']		= $pecah[2];
			$data['scriptmce']	= $this->scripttiny_mce();
			if($data["status"]	=="administrator")
			{
				$total					= $this->Webadmin_model->Total_Data("tbl_artikel");
				$config['base_url']		= base_url().'/index.php/webadmin/artikel/';
				$config['total_rows']	= $total->num_rows();
				$config['per_page']		= $limit;
				$config['uri_segment']	= 3;
				$config['first_link']	= 'Awal';
				$config['last_link']	= 'Akhir';
				$config['next_link']	= 'Selanjutnya';
				$config['prev_link']	= 'Sebelumnya';
				$this->pagination->initialize($config);
				$data['paginator'] 		= $this->pagination->create_links();;
				$data['daftarartikel'] 	= $this->Webadmin_model->Artikel($offset,$limit);
				$this->load->view('webadmin/bg_atas',$data);
				$this->load->view('webadmin/bg_menu');
				$this->load->view('webadmin/artikel',$data);
				$this->load->view('webadmin/bg_bawah');
			}
			else
			{
				?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function tambahberita()
	{
		$page=$this->uri->segment(3);
      	$limit=10;
			if(!$page):
				$offset = 0;
			else:
			$offset = $page;
			endif;
			$data = array();
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["tanggal"] = mdate($datestring, $time);
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
			$pecah				= explode("|",$session);
			$data["type"] 		= "Tambah Berita";
			$data["page"] 		= $page;
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$data["kategori"]		= $this->Webadmin_model->Pilih_Kategori("berita");
				$data["imglist"]		= $this->Webadmin_model->getDataFile();
				$data['daftarartikel'] 	= $this->Webadmin_model->Artikel($offset,$limit);
				$this->load->view('webadmin/bg_atas',$data);
				$this->load->view('webadmin/bg_menu');
				$this->load->view('webadmin/tambah_berita',$data);
				$this->load->view('webadmin/bg_bawah');
			}
			else
			{
				?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function simpanartikel()
	{
		$data		= array();
		$data2		= array();
		$session	= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah			= explode("|",$session);
			$data['id_user']= $pecah[3];
			$data['status']	= $pecah[2];
			if($data['status']=="administrator")
			{
				$tgl 					= " %Y-%m-%d";
				$jam 					= "%h:%i:%a";
				$time 					= time();
				$content				= $this->input->post('content');
				$data2['tipe_artikel'] 	= $this->input->post('tipe');
				$data2['id_kategori'] 	= $this->input->post('kategori');
				$data2['judul'] 		= $this->input->post('judul');
				$data2['isi'] 			= preg_replace('#(href|src)="(.*?)/media#', '$1="'.base_url().'media', $content);
				$data2['id_penulis'] 	= $data['id_user'];
				$data2["tanggal"] 		= mdate($tgl,$time);
				$data2["waktu"] 		= mdate($jam,$time);
				$data['scriptmce'] 		= $this->scripttiny_mce();
				if(empty($content)&&empty($data2["judul"]))
				{
					echo "<center><h3> data masih kosong </h3></center>";
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/artikel'>";
				}
				else
				{
					if($data2['tipe_artikel'] == 'berita')
					{
						$config['upload_path'] 	= './system/application/views/web/berita/';
					}
					else
					{
						$config['upload_path'] 	= './system/application/views/web/tutorial/';
					}
					$config['allowed_types']	= 'bmp|gif|jpg|jpeg|png';
					$config['max_size'] 		= '1000';
					$config['max_width'] 		= '400';
					$config['max_height'] 		= '400';
					$this->load->library('upload',$config);
					if(empty($_FILES['userfile']['name']))
					{
						$data2['gambar']		= "welcome.jpg";
						$this->webadmin_model->Simpan_Artikel($data2);
						?>
						<script type="text/javascript" language="javascript">
							alert("Berhasil Disimpan. Terima Kasih");
						</script>
						<?php
						echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/artikel'>";
					}
					else
					{
						if(!$this->upload->do_upload())
						{
							echo $this->upload->display_errors();
						}
						else 
						{
							$data2["gambar"]=$_FILES['userfile']['name'];
							$this->Webadmin_model->Simpan_Artikel($data2);
							?>
							<script type="text/javascript" language="javascript">
								alert("Berhasil Disimpan. Terima Kasih");
							</script>
							<?php
							echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/artikel'>";
						}
					}
				}
			}
			else
			{
					?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	
	function hapusartikel()
	{
		$id			= '';
		if ($this->uri->segment(3) === FALSE)
		{
			$id=$id;
		}
		else
		{
			$id=$this->uri->segment(3);
		}
		$data			= array();
		$session		= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!='')
		{
			$pecah			= explode("|",$session);
			$data['username']	= $pecah[0];
			$data['nama']		= $pecah[1];
			$data['status']		= $pecah[2];
			$data['scriptmce']	= $this->scripttiny_mce();
			if($data["status"]	=="administrator")
			{
				$this->Webadmin_model->Delete_Content($id,"id_artikel","tbl_artikel");
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/artikel'>";
			}
			else
			{
				?>
				<script type="text/javascript" language="javascript">
				alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
		}
		
	}
	
	function editartikel()
	{
		$id	= "";
		if($this->uri->segment(3) === FALSE)
		{
			$id	= $id;
		}
		else
		{
			$id	= $this->uri->segment(3);
		}
		$datestring			= "Login :  : %d-%m-%Y pukul %h:%i %a";
		$time				= time();
		$data				= array();
		$data["tanggal"]	= mdate($datestring,$time);
		$session	= isset($_SESSION['username_belajar'])? $_SESSION['username_belajar']:'';
		if ($session!="")
		{
			$pecah				= explode("|",$session);
			$data["type"] 		= "Edit Artikel";
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$data["kategori"]	= $this->Webadmin_model->Semua_Kategori();
				$data["edit"]		= $this->Webadmin_model->Edit_Content("tbl_artikel","id_artikel=$id");
				$data["imglist"]	= $this->Webadmin_model->getDataFile();
				$this->load->view('webadmin/bg_atas',$data);
				$this->load->view('webadmin/bg_menu');
				$this->load->view('webadmin/edit_artikel',$data);
				$this->load->view('webadmin/bg_bawah');
			}
			else 
			{
				?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function simpanfile()
	{
		$title		= $this->input->post('title');
		$description= $this->input->post('description');
		$filetype	= $this->input->post('filetype');
		if($_FILES['imagefile']['type'] == "application/pdf")
		{
			$ori_src="media/file/".strtolower(str_replace(' ','_',$_FILES['imagefile']['name']));
		}
		else
		{
			$ori_src="media/file/".strtolower( str_replace(' ','_',$_FILES['imagefile']['name']) );
		}
		if(move_uploaded_file($_FILES['imagefile']['tmp_name'],$ori_src))
		{
			chmod("$ori_src",0777);
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Gagal Melakukan proses upload file, mungkin disebabkan ukuran file yang terlalu besar atau koneksi jaringan anda sedang bermasalah");
				</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/artikel'>";
			exit;
			//echo "gagal Melakukan Proses"
		}
		
		if ($_FILES['imagefile']['type'] == "application/pdf")
		{
			$thumb_src="media/file/".strtolower( str_replace(' ','_',$_FILES['imagefile']['name']) );
		}
		else 
		{
			$thumb_src="media/file/".strtolower( str_replace(' ','_',$_FILES['imagefile']['name']) );
		}
		
		$data 						= array();
		$data["title"] 				= $title;
		$data["image_description"] 	= $description;
		$data["image_url"] 			= $thumb_src;
		$data["file_type"] 			= $filetype;
		$data["uploaded_date"] 		= date("Y-m-d H:m:s");
		$this->Webadmin_model->Simpan_Gambar($data);
		?>
			<script type="text/javascript" language="javascript">
				alert("File Berhasil DiUpload. Terimakasih");
			</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/artikel'>";
	}
	
	function updateartikel()
	{
		$data2 = array();
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$tipe			=$this->input->post('tipe');
				$config['upload_path'] 		= './system/application/views/web/'.$tipe.'/';
				$config['allowed_types'] 	= 'bmp|gif|jpg|jpeg|png';
				$config['max_size'] 		= '1000';
				$config['max_width'] 		= '400';
				$config['max_height'] 		= '400';						
				$this->load->library('upload', $config);
		
				if(empty($_FILES['userfile']['name']))
				{
					$data2["judul"]			= $this->input->post('judul');
					$data2["isi"]			= $this->input->post('content');
					$data2["id_artikel"]	= $this->input->post('id_artikel');
					$data2["tipe_artikel"]  = $this->input->post('tipe');
					$data2["id_kategori"]	= $this->input->post('kategori');
					$this->Webadmin_model->Update_Content("tbl_artikel",$data2,"id_artikel");
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/artikel'>";
				}
				else
				{
					if(!$this->upload->do_upload())
					{
						echo $config['upload_path'];
						echo $this->upload->display_errors();
					}
					else 
					{
						$data2["gambar"]		= $_FILES['userfile']['name'];
						$data2["judul"]			= $this->input->post('judul');
						$data2["isi"]			= $this->input->post('content');
						$data2["id_artikel"]	= $this->input->post('id_artikel');
						$data2["tipe_artikel"]	= $this->input->post('tipe');
						$data2["id_kategori"]	= $this->input->post('kategori');
						$this->Webadmin_model->Update_Content("tbl_artikel",$data2,"id_artikel");
							echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/artikel'>";
					}
				}
			}
			else
			{
				?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
		}
	}
	
	
	function tambahtutorial()
	{
		$page=$this->uri->segment(3);
      	$limit=10;
			if(!$page):
				$offset = 0;
			else:
			$offset = $page;
			endif;
		$data 				= array();
		$datestring 		= "Login : %d-%m-%Y pukul %h:%i %a";
		$time 				= time();
		$data 				= array();
		$data["tanggal"] 	= mdate($datestring, $time);
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
			$pecah				= explode("|",$session);
			$data["type"] 		= "Tambah Tutorial";
			$data["page"] 		= $page;
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]	=="administrator")
			{
				$data["kategori"]		= $this->Webadmin_model->Pilih_Kategori("tutorial");
				$data["imglist"]		= $this->Webadmin_model->getDataFile();
				$data['daftarartikel'] 	= $this->Webadmin_model->Artikel($offset,$limit);
				$this->load->view('webadmin/bg_atas',$data);
				$this->load->view('webadmin/bg_menu');
				$this->load->view('webadmin/tambah_tutorial',$data);
				$this->load->view('webadmin/bg_bawah');
			}
			else
			{
				?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function uploadfile()
	{
		$title		= $this->input->post('title');
		$description= $this->input->post('description');
		$filetype	= $this->input->post('filetype');
		if($_FILES['imagefile']['type'] == "application/pdf")
		{
			$ori_src="media/file/".strtolower(str_replace(' ','_',$_FILES['imagefile']['name']));
		}
		else
		{
			$ori_src="media/file/".strtolower( str_replace(' ','_',$_FILES['imagefile']['name']) );
		}
		if(move_uploaded_file($_FILES['imagefile']['tmp_name'],$ori_src))
		{
			chmod("$ori_src",0777);
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Gagal Melakukan proses upload file, mungkin disebabkan ukuran file yang terlalu besar atau koneksi jaringan anda sedang bermasalah");
				</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/artikel'>";
			exit;
			//echo "gagal Melakukan Proses"
		}
		
		if ($_FILES['imagefile']['type'] == "application/pdf")
		{
			$thumb_src="media/file/".strtolower( str_replace(' ','_',$_FILES['imagefile']['name']) );
		}
		else 
		{
			$thumb_src="media/file/".strtolower( str_replace(' ','_',$_FILES['imagefile']['name']) );
		}
		
		$data 						= array();
		$data["title"] 				= $title;
		$data["image_description"] 	= $description;
		$data["image_url"] 			= $thumb_src;
		$data["file_type"] 			= $filetype;
		$data["uploaded_date"] 		= date("Y-m-d H:m:s");
		$this->Webadmin_model->Simpan_Gambar($data);
		?>
			<script type="text/javascript" language="javascript">
				alert("File Berhasil DiUpload. Terimakasih");
			</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/artikel'>";
	}
	
	function hapusmedia()
	{
		$id				= "";
		if($this->uri->segment(3) === FALSE)
		{
			$id	= $id;
		}
		else
		{
			$id = $this->uri->segment(3);
		}
		$imgdb	= $this->Webadmin_model->getDataFile();
		foreach($imgdb->result_array()as $row)
		{
			$filename	= $row['image_url'];
			$filetype	= $row['file_type'];
		}
		if(file_exists($filename))
		{
			if(@unlink($filename))
			{
				@unlink(str_replace($filename));
			}
		}
		$this->Webadmin_model->Hapus_Media($id);
				?>
				<script type="text/javascript" language="javascript">
					alert("File Berhasil Dihapus. Terimakasih");
				</script>
				<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/artikel'>";
	}
	
	function hapusfile()
	{
		$id				= "";
		if($this->uri->segment(3) === FALSE)
		{
			$id	= $id;
		}
		else
		{
			$id = $this->uri->segment(3);
		}
		$imgdb	= $this->Webadmin_model->getDataFile();
		foreach($imgdb->result_array()as $row)
		{
			$filename	= $row['image_url'];
			$filetype	= $row['file_type'];
		}
		if(file_exists($filename))
		{
			if(@unlink($filename))
			{
				@unlink(str_replace($filename));
			}
		}
		$this->Webadmin_model->Hapus_Media($id);
				?>
				<script type="text/javascript" language="javascript">
					alert("File Berhasil Dihapus. Terimakasih");
				</script>
				<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/upload'>";
	}
	
	function tambahkategori()
	{
		$page=$this->uri->segment(3);
      	$limit		=7;
		if(!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data 				= array();
		$datestring 		= "Login : %d-%m-%Y pukul %h:%i %a";
		$time 				= time();
		$data 				= array();
		$data["tanggal"] 	= mdate($datestring, $time);
		$session			= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data["type"] 		= "Kategori Artikel";
			$data["page"] 		= $page;
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$total 					= $this->Webadmin_model->Total_Data("tbl_kategori_artikel");
				$config['base_url'] 	= base_url() . '/index.php/webadmin/tambahkategori/';
				$config['total_rows'] 	= $total->num_rows();
				$config['per_page'] 	= $limit;
				$config['uri_segment'] 	= 3;
				$config['first_link'] 	= 'Awal';
				$config['last_link'] 	= 'Akhir';
				$config['next_link'] 	= 'Selanjutnya';
				$config['prev_link'] 	= 'Sebelumnya';
				$this->pagination->initialize($config);
				$data['paginator'] 		= $this->pagination->create_links();
				$data['daftarartikel'] 	= $this->Webadmin_model->List_Kategori($offset,$limit);
				$this->load->view('webadmin/bg_atas',$data);
				$this->load->view('webadmin/bg_menu');
				$this->load->view('webadmin/kategori',$data);
				$this->load->view('webadmin/bg_bawah');
			}
			else
			{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function simpankategori()
	{
		$data			= array();
		$data2			= array();
		$session		= isset($_SESSION['username_belajar'])? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data['id_user'] 	= $pecah[3];
			$data["status"] 	= $pecah[2];
			if($data["status"]=="administrator")
			{
				$tgl 				= " %Y-%m-%d";
				$jam 				= "%h:%i:%a";
				$time 				= time();
				$content			= $this->input->post('content');
				$data2['type'] 		= $this->input->post('tipe');
				$data2['nama_kat']	= $this->input->post('nama_kat');
				$data['scriptmce'] 	= $this->scripttiny_mce();
				
				if(empty($data2['nama_kat']))
				{
					?>
					<script type="text/javascript" language="javascript">
						alert("Data Masih Kosong");
					</script>
					<?php
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/tambahkategori'>";
				}
				else
				{
					$this->Webadmin_model->Simpan_Kategori($data2);
	   				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/tambahkategori'>";
					?>
					<script type="text/javascript" language="javascript">
						alert("Kategori Berhasil Ditambahkan");
					</script>
					<?php
				}
			}
			else
			{
				?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function hapuskategori()
	{
		$id='';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id=$id;
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data 			= array();
		$session		= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data["username"]	= $pecah[0];
			$data["nama"] 		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$this->Webadmin_model->Delete_Content($id,"id_kat","tbl_kategori_artikel");
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/tambahkategori'>";
			}
			else
			{
				?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
		}
	}
	
	function event()
	{
		$page			= $this->uri->segment(3);
		$limit			= 10;
		if(!$page):
			$offset	= 0;
		else:
			$offset	= $page;
		endif;
		$data				= array();
		$datestring 		= "Login : %d-%m-%Y pukul %h:%i %a";
		$time 				= time();
		$data 				= array();
		$data["tanggal"] 	= mdate($datestring, $time);
		$session			= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data["type"] 		= "Event";
			$data["page"] 		= $page;
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$total 					= $this->Webadmin_model->Total_Data("tbl_event");
				$config['base_url'] 	= base_url() . '/index.php/webadmin/event/';
				$config['total_rows'] 	= $total->num_rows();
				$config['per_page'] 	= $limit;
				$config['uri_segment'] 	= 3;
				$config['first_link'] 	= 'Awal';
				$config['last_link'] 	= 'Akhir';
				$config['next_link'] 	= 'Selanjutnya';
				$config['prev_link'] 	= 'Sebelumnya';
				$this->pagination->initialize($config);
				$data['paginator'] 		= $this->pagination->create_links();
				$data['daftarartikel'] 	= $this->Webadmin_model->Event($offset,$limit);
					$this->load->view('webadmin/bg_atas',$data);
					$this->load->view('webadmin/bg_menu');
					$this->load->view('webadmin/event',$data);
					$this->load->view('webadmin/bg_bawah');
			}
			else
			{
				?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
			
	}
	
	function tambahevent()
	{
		$data			= array();
		$datestring		= "Login : %d-%m-%Y pukul %h:%i %a";
		$time			= time();
		$data["tanggal"]= mdate($datestring,$time);
		$session		= isset($_SESSION['username_belajar']) ? $_SESSION["username_belajar"]:'';
		if($session !="")
		{
			$pecah				= explode("|",$session);
			$data["type"] 		= "Event";
			$data["username"]	= $pecah[0];
			$data["nama"]       = $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$data["imglist"]		= $this->Webadmin_model->getDataFile();
				$this->load->view('webadmin/bg_atas',$data);
				$this->load->view('webadmin/bg_menu');
				$this->load->view('webadmin/tambah_event',$data);
				$this->load->view('webadmin/bg_bawah');
			}
			else
			{
				?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
				<?php
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function simpanevent()
	{
		$data 					= array();
		$data2 					= array();
		$session				= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah						= explode("|",$session);
			$data['id_user'] 			= $pecah[3];
			$data["status"] 			= $pecah[2];
			if($data["status"]=="administrator")
			{
				$tgl 					= " %Y-%m-%d";
				$jam 					= "%h:%i:%a";
				$time 					= time();
				$content				= $this->input->post('content');
				$data2['type'] 			= $this->input->post('tipe');
				$data2['title'] 		= $this->input->post('judul');
				$data2['content'] 		= $content = preg_replace('|"(\.\.(.*)/media)|', '"'.base_url().'media', $content);;
				$data2['id_penulis'] 	= $data['id_user'];
				$data2["posting_date"] 	= mdate($tgl,$time);
				$data['scriptmce'] 		= $this->scripttiny_mce();
			
				if(empty($content) && empty($data2["judul"]))
				{
					echo "<center><h3> data masih kosong </h3></center>";
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/tambahevent'>";
				}
				else
				{
					$this->Webadmin_model->Simpan_Event($data2);
					?>
						<script type="text/javascript" language="javascript">
							alert("Berhasil Disimpan. Terima Kasih");
						</script>
					<?php
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/event'>";
				}
				
			}
			else
			{
				?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
				<?php
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function hapusevent()
	{
		$id='';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id=$id;
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data 					= array();
		$session				= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah					= explode("|",$session);
			$data["username"]		= $pecah[0];
			$data["nama"]			= $pecah[1];
			$data["status"]			= $pecah[2];
			$data['scriptmce'] 		= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$this->Webadmin_model->Delete_Content($id,"id","tbl_event");
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/event'>";
			}
			else
			{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
				</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
		}
	}
	
	function editevent()
	{
		$id			= '';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id	= $id;
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$datestring 				= "Login : %d-%m-%Y pukul %h:%i %a";
		$time 						= time();
		$data 						= array();
		$data["tanggal"] 			= mdate($datestring, $time);
		$session					= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah					= explode("|",$session);
			$data["type"] 			= "Edit Artikel";
			$data["username"]		= $pecah[0];
			$data["nama"]			= $pecah[1];
			$data["status"]			= $pecah[2];
			$data['scriptmce'] 		= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$data['edit'] 		= $this->Webadmin_model->Edit_Content("tbl_event","id=$id");
				$data["imglist"]	=$this->Webadmin_model->getDataFile();
				$this->load->view('webadmin/bg_atas',$data);
				$this->load->view('webadmin/bg_menu');
				$this->load->view('webadmin/edit_event',$data);
				$this->load->view('webadmin/bg_bawah');
			}
			else
			{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function updateevent()
	{
		$data2 					= array();
		$session				= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$data2['type']		= $this->input->post('tipe');
				$data2['title']		= $this->input->post('judul');
				$data2['content']	= $this->input->post('content');
				$data2['id']		= $this->input->post('id');
				$this->Webadmin_model->Update_Content("tbl_event",$data2,"id");
					?>
						<script type="text/javascript" language="javascript">
							alert("Berhasil Disimpan. Terima Kasih");
						</script>
					<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/event'>";
			}
			else
			{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
		}
	}
	
	function datastatis()
	{
		$page		= $this->uri->segment(3);
      	$limit		= 10;
		if(!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data 				= array();
		$datestring 		= "Login : %d-%m-%Y pukul %h:%i %a";
		$time 				= time();
		$data 				= array();
		$data["tanggal"] 	= mdate($datestring, $time);
		$session			= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data["type"] 		= "Data Statis";
			$data["page"] 		= $page;
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$total 					= $this->Webadmin_model->Total_Data("tbl_data");
				$config['base_url'] 	= base_url() . '/index.php/webadmin/datastatis/';
				$config['total_rows'] 	= $total->num_rows();
				$config['per_page'] 	= $limit;
				$config['uri_segment'] 	= 3;
				$config['first_link'] 	= 'Awal';
				$config['last_link'] 	= 'Akhir';
				$config['next_link'] 	= 'Selanjutnya';
				$config['prev_link'] 	= 'Sebelumnya';
				$this->pagination->initialize($config);
				$data['paginator'] 		= $this->pagination->create_links();
				$data['daftarartikel'] 	= $this->Webadmin_model->Data_Statis($offset,$limit);
				$this->load->view('webadmin/bg_atas',$data);
				$this->load->view('webadmin/bg_menu');
				$this->load->view('webadmin/data_statis',$data);
				$this->load->view('webadmin/bg_bawah');
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function tambahdatastatis()
	{
		$data 				= array();
		$datestring 		= "Login : %d-%m-%Y pukul %h:%i %a";
		$time 				= time();
		$data 				= array();
		$data["tanggal"] 	= mdate($datestring, $time);
		$session			= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah					= explode("|",$session);
			$data["type"] 			= "Data Statis";
			$data["username"]		= $pecah[0];
			$data["nama"]			= $pecah[1];
			$data["status"]			= $pecah[2];
			$data['scriptmce'] 		= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$data["statis"] 	= $this->Webadmin_model->Menu_Statis();
				$data["imglist"]	= $this->Webadmin_model->getDataFile();
				$this->load->view('webadmin/bg_atas',$data);
				$this->load->view('webadmin/bg_menu');
				$this->load->view('webadmin/tambah_data_statis',$data);
				$this->load->view('webadmin/bg_bawah');
			}
			else
			{
				?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function simpandatastatis()
	{
		$data 					= array();
		$data2 					= array();
		$session				= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah					= explode("|",$session);
			$data['id_user'] 		= $pecah[3];
			$data['status'] 		= $pecah[2];
			$data['username'] 		= $pecah[0];
			if($data["status"]=="administrator")
			{
				$tgl 				= " %Y-%m-%d";
				$jam 				= "%h:%i:%a";
				$time 				= time();
				$data2["title"]		= $this->input->post('judul');
				$data2["author"]	= $data['username'];
				$data2["data_id"]	= $this->input->post('data_id');
				$content=$this->input->post('content');
				$data2["content"] 	= preg_replace('#(href|src)="(.*?)/media#', '$1="'.base_url().'media', $content);
				$data['scriptmce'] 	= $this->scripttiny_mce();
		
				if(empty($data2["content"]))
				{
					echo "<center><h3> data masih kosong </h3></center>";
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/datastatis'>";
				}
				else{
					$this->Webadmin_model->Simpan_Data_Statis($data2);
						?>
							<script type="text/javascript" language="javascript">
								alert("Data Berhasil disimpan. Terimakasih");
							</script>
						<?php
	   				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/datastatis'>";
				}
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function hapusdatastatis() 
	{
		$id				= '';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id		= $id;
		}
		else
		{
    			$id 	= $this->uri->segment(3);
		}
		$data 					= array();
		$session				= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$this->Webadmin_model->Delete_Content($id,"id_data","tbl_data");
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/datastatis'>";
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function editdatastatis() 
	{
		$id					= '';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id			= $id;
		}
		else
		{
    			$id 		= $this->uri->segment(3);
		}
		$data 					= array();
		$session				= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah					= explode("|",$session);
			$data["username"]		= $pecah[0];
			$data["nama"]			= $pecah[1];
			$data["status"]			= $pecah[2];
			$data["type"]			= "Edit Data Statis";
			$data['scriptmce'] 		= $this->scripttiny_mce();
			$datestring 			= "Login : %d-%m-%Y pukul %h:%i %a";
			$time 					= time();
			$data["tanggal"] 		= mdate($datestring, $time);
			if($data["status"]=="administrator")
			{
				$data["statis"] 	= $this->Webadmin_model->Menu_Statis();
				$data["edit"] 		= $this->Webadmin_model->Edit_Content("tbl_data","id_data=$id");
				$data["imglist"] 	= $this->Webadmin_model->getDataFile();
				$this->load->view('webadmin/bg_atas',$data);
				$this->load->view('webadmin/bg_menu');
				$this->load->view('webadmin/edit_data_statis',$data);
				$this->load->view('webadmin/bg_bawah');
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
				</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
		}
	}
	
	function updatedatastatis()
	{
		$data 					= array();
		$data2 					= array();
		$session				= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah					= explode("|",$session);
			$data['id_user'] 		= $pecah[3];
			$data['status'] 		= $pecah[2];
			$data['username'] 		= $pecah[0];
			if($data["status"]=="administrator")
			{
				$tgl 				= " %Y-%m-%d";
				$jam 				= "%h:%i:%a";
				$time 				= time();
				$gabung 			= $this->input->post('data_id');
				$pisah 				= explode("-",$gabung);
				$data2["data_id"] 	= $pisah[0];
				$data2["title"] 	= $pisah[1];
				$content			= $this->input->post('content');
				$data2["content"] 	= preg_replace('#(href|src)="(.*?)/media#', '$1="'.base_url().'media', $content);
				$data2["id_data"] 	= $this->input->post('id_data');
				$data['scriptmce'] 	= $this->scripttiny_mce();
			
				if(empty($data2["content"]))
				{
					echo "Data Masih Kosong";
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/datastatis'>";
				}
				else
				{
					$this->Webadmin_model->Update_Content("tbl_data",$data2,"id_data");
						?>
							<script type="text/javascript" language="javascript">
								alert("Data berhasil Di Update. Terimakasih");
							</script>
						<?php
	   				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/datastatis'>";
				}
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
				</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function polling()
	{
		$page	=	$this->uri->segment(3);
      	$limit	= 10;
		if(!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data 					= array();
		$datestring 			= "Login : %d-%m-%Y pukul %h:%i %a";
		$time 					= time();
		$data 					= array();
		$data["tanggal"] 		= mdate($datestring, $time);
		$session				= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah					= explode("|",$session);
			$data["type"] 			= "Polling";
			$data["username"]		= $pecah[0];
			$data["nama"]			= $pecah[1];
			$data["status"]			= $pecah[2];
			$data["page"]			= $page;
			$data['scriptmce'] 		= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$total 					= $this->Webadmin_model->Total_Data("tbl_pollingsoal");
				$config['base_url'] 	= base_url() . '/index.php/webadmin/polling/';
				$config['total_rows'] 	= $total->num_rows();
				$config['per_page'] 	= $limit;
				$config['uri_segment'] 	= 3;
				$config['first_link'] 	= 'Awal';
				$config['last_link'] 	= 'Akhir';
				$config['next_link'] 	= 'Next';
				$config['prev_link'] 	= 'Previous';
				$this->pagination->initialize($config);
				$data['paginator'] 		= $this->pagination->create_links();
				$data['daftarartikel'] 	= $this->Webadmin_model->Polling($offset,$limit);
					$this->load->view('webadmin/bg_atas',$data);
					$this->load->view('webadmin/bg_menu');
					$this->load->view('webadmin/polling',$data);
					$this->load->view('webadmin/bg_bawah');
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
				</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function tambahsoalpoll()
	{
		$page		= $this->uri->segment(3);
      	$limit		= 10;
		if(!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data 				= array();
		$datestring 		= "Login : %d-%m-%Y pukul %h:%i %a";
		$time 				= time();
		$data 				= array();
		$data["tanggal"] 	= mdate($datestring, $time);
		$session			= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data["type"] 		= "Polling";
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$this->load->view('webadmin/bg_atas',$data);
				$this->load->view('webadmin/bg_menu');
				$this->load->view('webadmin/tambah_soal_polling',$data);
				$this->load->view('webadmin/bg_bawah');
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
			}
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
				</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
		}
	}
	
	function simpansoalpoll()
	{
		$page	= $this->uri->segment(3);
      	$limit	= 10;
		if(!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data 					= array();
		$datestring 			= "Login : %d-%m-%Y pukul %h:%i %a";
		$time 					= time();
		$data 					= array();
		$data["tanggal"] 		= mdate($datestring, $time);
		$session				=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data["type"] 		= "Polling";
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$data2['soal'] 		= $this->input->post('soal');
				$data2['status'] 	= $this->input->post('status');
				if($data2['soal']=="")
				{
					echo "<center><h3> data masih kosong </h3></center>";
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/tambah_soal_polling'>";
				}
				else
				{
					$this->Webadmin_model->In_Polling("tbl_pollingsoal",$data2);
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/polling'>";
				}
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
						echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
				</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function hapussoalpoll()
	{
		$id				= '';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id		= $id;
		}
		else
		{
    			$id 	= $this->uri->segment(3);
		}
		$data 				= array();
		$session			= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah					= explode("|",$session);
			$data["username"]		= $pecah[0];
			$data["nama"]			= $pecah[1];
			$data["status"]			= $pecah[2];
			$data['scriptmce'] 		= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$this->Webadmin_model->Delete_Content($id,"id","tbl_pollingsoal");
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/polling'>";
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
				</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
		}
	}
	
	function editsoalpoll()
	{
		$id					= '';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id			= $id;
		}
		else
		{
    			$id 		= $this->uri->segment(3);
		}
		$data 				= array();
		$session			= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data["type"]		= "Polling";
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$data["edit"] 		= $this->Webadmin_model->Edit_Content("tbl_pollingsoal","id=$id");
					$this->load->view('webadmin/bg_atas',$data);
					$this->load->view('webadmin/bg_menu');
					$this->load->view('webadmin/edit_soal_polling',$data);
					$this->load->view('webadmin/bg_bawah');
			}	
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
				</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
		}
	}
	
	function updatesoalpoll()
	{
		$data 			= array();
		$data2 			= array();
		$session		= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data['id_user'] 	= $pecah[3];
			$data['status'] 	= $pecah[2];
			$data['username'] 	= $pecah[0];
			if($data["status"]=="administrator")
			{
				$tgl 				= " %Y-%m-%d";
				$jam 				= "%h:%i:%a";
				$time 				= time();
				$data2["soal"] 		= $this->input->post('soal');
				$data2["status"] 	= $this->input->post('status');
				$data2["id"] 		= $this->input->post('id');
				$data['scriptmce'] 	= $this->scripttiny_mce();
				
				if(empty($data2["soal"]))
				{
					echo "Data Masih Kosong";
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/polling'>";
				}
				else
				{
					$this->Webadmin_model->Update_Content("tbl_pollingsoal",$data2,"id");
	   				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/polling'>";
				}
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
			}
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
				</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
		}
	}
	
	function tambahjwbpoll()
	{
		$page		= $this->uri->segment(3);
      	$limit		= 10;
		if(!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data 						= array();
		$datestring 				= "Login : %d-%m-%Y pukul %h:%i %a";
		$time 						= time();
		$data 						= array();
		$data["tanggal"] 			= mdate($datestring, $time);
		$session					= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah					= explode("|",$session);
			$data["type"] 			= "Jawaban Polling";
			$data["username"]		= $pecah[0];
			$data["nama"]			= $pecah[1];
			$data["page"]			= $page;
			$data["status"]			= $pecah[2];
			$data['scriptmce'] 		= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$total 					= $this->Webadmin_model->Total_Data("tbl_pollingjawaban");
				$config['base_url'] 	= base_url() . '/index.php/webadmin/tambahjwbpoll/';
				$config['total_rows'] 	= $total->num_rows();
				$config['per_page'] 	= $limit;
				$config['uri_segment'] 	= 3;
				$config['first_link'] 	= 'Awal';
				$config['last_link'] 	= 'Akhir';
				$config['next_link'] 	= 'Next';
				$config['prev_link'] 	= 'Previous';
					$this->pagination->initialize($config);
				$data['paginator'] 		= $this->pagination->create_links();
				$data['daftarartikel'] 	= $this->Webadmin_model->Jawaban_Polling($offset,$limit);
				$data['soal'] 			= $this->Webadmin_model->Soal_Poll();
					$this->load->view('webadmin/bg_atas',$data);
					$this->load->view('webadmin/bg_menu');
					$this->load->view('webadmin/tambah_jwb_polling',$data);
					$this->load->view('webadmin/bg_bawah');
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
			}
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
				</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
		}
	}
	
	function simpanjwbpoll()
	{
		$page		= $this->uri->segment(3);
      	$limit		= 10;
		if(!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data 						= array();
		$datestring 				= "Login : %d-%m-%Y pukul %h:%i %a";
		$time 						= time();
		$data 						= array();
		$data["tanggal"] 			= mdate($datestring, $time);
		$session					= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah					= explode("|",$session);
			$data["type"] 			= "Polling";
			$data["username"]		= $pecah[0];
			$data["nama"]			= $pecah[1];
			$data["status"]			= $pecah[2];
			$data['scriptmce'] 		= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$data2['id_soal'] 	= $this->input->post('pertanyaan');
				$data2['jawaban'] 	= $this->input->post('jawaban');
				$data2['counter'] 	= 1;
				if($data2['jawaban']=="")
				{
					echo "Data Masih Kosong";
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/tambahjwbpoll'>";
				}
				else
				{
					$this->Webadmin_model->In_Polling("tbl_pollingjawaban",$data2);
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/tambahjwbpoll'>";
				}
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
			}
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
				</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
		}
	}
	
	function hapusjwbpoll()
	{
		$id					= '';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id	=	$id;
		}
		else
		{
    			$id	= $this->uri->segment(3);
		}
		$data 				= array();
		$session			= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$this->Webadmin_model->Delete_Content($id,"id_jawaban","tbl_pollingjawaban");
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/tambahjwbpoll'>";
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
				</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
		}
	}
	
	function editjwbpoll()
	{
		$id			= '';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id	= $id;
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data 							= array();
		$datestring 					= "Login : %d-%m-%Y pukul %h:%i %a";
		$time 							= time();
		$data["tanggal"] 				= mdate($datestring, $time);
		$session						= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah						= explode("|",$session);
			$data["username"]			= $pecah[0];
			$data["nama"]				= $pecah[1];
			$data["status"]				= $pecah[2];
			$data["type"]				= "Polling";
			$data['scriptmce'] 			= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$data['soal'] 			= $this->Webadmin_model->Soal_Poll();
				$data["edit"] 			= $this->Webadmin_model->Edit_Content("tbl_pollingjawaban","id_jawaban=$id");
					$this->load->view('webadmin/bg_atas',$data);
					$this->load->view('webadmin/bg_menu');
					$this->load->view('webadmin/edit_jwb_polling',$data);
					$this->load->view('webadmin/bg_bawah');
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
				</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
		}
	}
	
	function updatejwbpoll()
	{
		$data 						= array();
		$data2 						= array();
		$session					= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah					= explode("|",$session);
			$data['id_user'] 		= $pecah[3];
			$data['status'] 		= $pecah[2];
			$data['username'] 		= $pecah[0];
			if($data["status"]=="administrator")
			{
				$tgl 					= " %Y-%m-%d";
				$jam 					= "%h:%i:%a";
				$time 					= time();
				$data2["id_soal"] 		= $this->input->post('id_soal');
				$data2["jawaban"] 		= $this->input->post('jawaban');
				$data2["id_jawaban"] 	= $this->input->post('id');
				$data2["counter"] 		= $this->input->post('counter');
				$data['scriptmce'] 		= $this->scripttiny_mce();
					$this->Webadmin_model->Update_Content("tbl_pollingjawaban",$data2,"id_jawaban");
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/tambahjwbpoll'>";
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
					</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
			}
		}
		else
		{
			?>
				<script type="text/javascript" language="javascript">
					alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
				</script>
			<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
		}
	}
	
	function passwordganti()
	{
		$session						= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$this->load->view('webadmin/ganti_password',$data);
		}
		else {
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
		}
	}
	
	function updatepassword()
	{
		$username				= $this->input->post('username');
		$psw					= $this->input->post('pwd');
		$psw_lama				= $this->input->post('pwd_lama');
			$this->load->model('Webadmin_model');
		$hasil 					= $this->Webadmin_model->Data_Login($username,$psw_lama);
		if(count($hasil->result()) <= 0)
		{
			?>
			<script type="text/javascript">
				alert('Password lama yang anda masukkan SALAH..!!!');
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/passwordganti'>";
		}
		else if($psw!="" AND $psw_lama!="")
		{
			$this->Webadmin_model->Update_Password($username,$psw);
			echo "<font size='3' face='arial'><i>Sukses memperbarui password.</i>
					<br> 
					<table>
						<tr>
							<td>Password anda yang baru</td>
							<td>:</td>
							<td>".$psw."</td>
						</tr>
						<tr>
							<td>Dengan username</td>
							<td>:</td>
							<td>".$username."</td>
						</tr>
					</table></b>";
		}
		else
		{
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/learning/passwordmhs'>";
		}
	}
	
	function galeri()
	{
		$page				= $this->uri->segment(3);
      	$limit				= 10;
		if(!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data 				= array();
		$datestring 		= "Login : %d-%m-%Y pukul %h:%i %a";
		$time 				= time();
		$data 				= array();
		$data["tanggal"] 	= mdate($datestring, $time);
		$session			= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah					= explode("|",$session);
			$data["type"] 			= "Galeri Kegiatan";
			$data["username"]		= $pecah[0];
			$data["nama"]			= $pecah[1];
			$data["status"]			= $pecah[2];
			$data["page"]			= $page;
			$data['scriptmce'] 		= $this->scripttiny_mce();
				if($data["status"]=="administrator")
				{
					$total 						= $this->Webadmin_model->Total_Data("tbl_album_galeri");
					$config['base_url'] 		= base_url() . '/index.php/webadmin/galeri/';
					$config['total_rows'] 		= $total->num_rows();
					$config['per_page'] 		= $limit;
					$config['uri_segment'] 		= 3;
					$config['first_link'] 		= 'Awal';
					$config['last_link'] 		= 'Akhir';
					$config['next_link'] 		= 'Selanjutnya';
					$config['prev_link'] 		= 'Sebelumnya';
						$this->pagination->initialize($config);
					$data['paginator'] 			= $this->pagination->create_links();
					$data['daftarartikel'] 		= $this->Webadmin_model->Album_Galeri($offset,$limit);
						$this->load->view('webadmin/bg_atas',$data);
						$this->load->view('webadmin/bg_menu');
						$this->load->view('webadmin/galeri',$data);
						$this->load->view('webadmin/bg_bawah');
				}
				else
				{
				?>
				<script type="text/javascript" language="javascript">
					alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
				</script>
				<?php
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
				}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function hapusalbum()
	{
		$id='';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id=$id;
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data = array();
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
		$pecah=explode("|",$session);
		$data["username"]=$pecah[0];
		$data["nama"]=$pecah[1];
		$data["status"]=$pecah[2];
	   	$data['scriptmce'] = $this->scripttiny_mce();
			if($data["status"]=="administrator"){
			$this->Webadmin_model->Delete_Content($id,"id_album","tbl_album_galeri");
	   		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/galeri'>";
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
		alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
		</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
	}
	
	function simpanalbum()
	{
		$page=$this->uri->segment(3);
      	$limit=10;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$data = array();
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["tanggal"] = mdate($datestring, $time);
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
		$pecah=explode("|",$session);
		$data["type"] = "Galeri";
		$data["username"]=$pecah[0];
		$data["nama"]=$pecah[1];
		$data["status"]=$pecah[2];
	   	$data['scriptmce'] = $this->scripttiny_mce();
			if($data["status"]=="administrator"){
			$data2['nama_album'] = $this->input->post('nama');
				if($data2['nama_album']=="")
				{
					echo "Data Masih Kosong";
				}
				else{
					$this->Webadmin_model->In_Polling("tbl_album_galeri",$data2);
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/galeri'>";
				}
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function editalbum()
	{
		$id='';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id=$id;
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data = array();
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
		$pecah=explode("|",$session);
		$data["username"]=$pecah[0];
		$data["nama"]=$pecah[1];
		$data["status"]=$pecah[2];
		$data["type"]="Polling";
	   	$data['scriptmce'] = $this->scripttiny_mce();
			if($data["status"]=="administrator"){
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_album_galeri","id_album=$id");
			$this->load->view('webadmin/bg_atas',$data);
			$this->load->view('webadmin/bg_menu');
			$this->load->view('webadmin/edit_album',$data);
			$this->load->view('webadmin/bg_bawah');
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
		alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
		</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
	}
	
	function updatealbum()
	{
		$data = array();
		$data2 = array();
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
		$pecah=explode("|",$session);
		$data['id_user'] = $pecah[3];
		$data['status'] = $pecah[2];
		$data['username'] = $pecah[0];
			if($data["status"]=="administrator"){
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$data2["id_album"] = $this->input->post('id');
			$data2["nama_album"] = $this->input->post('nama');
			$data['scriptmce'] = $this->scripttiny_mce();
			$this->Webadmin_model->Update_Content("tbl_album_galeri",$data2,"id_album");
	   		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/galeri'>";
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function tambahfoto()
	{
		$page=$this->uri->segment(3);
      	$limit=10;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$data = array();
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["tanggal"] = mdate($datestring, $time);
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
		$pecah=explode("|",$session);
		$data["type"] = "Galeri Kegiatan";
		$data["username"]=$pecah[0];
		$data["nama"]=$pecah[1];
		$data["status"]=$pecah[2];
		$data["page"]=$page;
	   	$data['scriptmce'] = $this->scripttiny_mce();
			if($data["status"]=="administrator"){
			$total = $this->Webadmin_model->Total_Data("tbl_galeri");
			$config['base_url'] = base_url() . '/index.php/webadmin/tambahfoto/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['album'] = $this->Webadmin_model->Semua_Album();
			$data['daftarartikel'] = $this->Webadmin_model->Foto($offset,$limit);
			$this->load->view('webadmin/bg_atas',$data);
			$this->load->view('webadmin/bg_menu');
			$this->load->view('webadmin/foto',$data);
			$this->load->view('webadmin/bg_bawah');
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function uploadfoto()
	{
		$page		= $this->uri->segment(3);
      	$limit		= 10;
		if(!$page):
			$offset = 0;
		else:
			$offset = $page;
		endif;
		$data 				= array();
		$datestring 		= "Login : %d-%m-%Y pukul %h:%i %a";
		$time 				= time();
		$data 				= array();
		$data["tanggal"] 	= mdate($datestring, $time);
		$session			= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah				= explode("|",$session);
			$data["type"] 		= "Galeri";
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] 	= $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
//-------------------------------------------------------------------------------------	
			$acak				= rand(00000000000,99999999999);
			$bersih				= $_FILES['userfile']['name'];
			$nm					= str_replace(" ","_","$bersih");
			$pisah				= explode(".",$nm);
			$nama_murni_lama 	= preg_replace("/^(.+?);.*$/", "\\1",$pisah[0]);
			$nama_murni			= strtolower($nama_murni_lama);
			$ekstensi_kotor 	= $pisah[1];
			
			$file_type 			= preg_replace("/^(.+?);.*$/", "\\1", $ekstensi_kotor);
			$file_type_baru 	= strtolower($file_type);
			
			$ubah				= $acak.'-'.$nama_murni; //tanpa ekstensi
			$n_baru 			= $ubah.'.'.$file_type_baru;
			$ori_src			= "application/views/web/galeri/".strtolower( str_replace(' ','_',$n_baru) );
			$thumb_src			= "application/views/web/galeri/thumb/".strtolower( str_replace(' ','_','kecil-'.$n_baru) );
				if(move_uploaded_file ($_FILES['userfile']['tmp_name'],$ori_src))
				{
					chmod("$ori_src",0777);
				}else
				{
					?>
					<script type="text/javascript" language="javascript">
						alert("Gagal melakukan proses upload file.Hal ini biasanya disebabkan ukuran file yang terlalu besar atau koneksi jaringan anda sedang bermasalah");
					</script>
					<?php
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/tambahfoto'>";
				}
				list($width, $height) 	= getimagesize($ori_src) ;
				if($height > $width)
					{
						$x_height		= 480; 
						$diff 			= $height / $x_height;
						$x_width 		= $width / $diff;
						
						$n_height		= 98; 
						$diff 			= $height / $n_height;
						$n_width 		= $width / $diff;
					}
				else
					{
						$x_width		= 640; 
						$diff 			= $width / $x_width;
						$x_height 		= $height / $diff;
						
						$n_width		= 130; 
						$diff 			= $width / $n_width;
						$n_height 		= $height / $diff;
					}
				if(($_FILES['userfile']['type']=="image/jpeg") || ($_FILES['userfile']['type']=="image/png") || ($_FILES['userfile']['type']=="image/gif"))
					{
						$im = @ImageCreateFromJPEG ($ori_src) or // Read JPEG Image
						$im = @ImageCreateFromPNG ($ori_src) or // or PNG Image
						$im = @ImageCreateFromGIF ($ori_src) or // or GIF Image
						$im = false; // If image is not JPEG, PNG, or GIF
						//$im=ImageCreateFromJPEG($ori_src); 

	
						if(!$im) 
						{
							echo '<p>Gagal membuat thumnail</p>';
							exit;
						}
						else 
						{	
							$newimage2=@imagecreatetruecolor($x_width,$x_height);                 
							@imageCopyResized($newimage2,$im,0,0,0,0,$x_width,$x_height,$width,$height);
							@ImageJpeg($newimage2,$ori_src);
							chmod("$ori_src",0777);
									
							$newimage=@imagecreatetruecolor($n_width,$n_height);                 
							@imageCopyResized($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
							@ImageJpeg($newimage,$thumb_src);
							chmod("$thumb_src",0777);
						}
					}
				
//---------------------------------------------------------------------------------------------------
			$data2['foto_besar'] 	= $n_baru;
			$data2['foto_kecil']	= 'kecil-'.$n_baru;
			$data2['id_album'] 		= $this->input->post('album');
			
			$this->Webadmin_model->In_Polling("tbl_galeri",$data2);
			?>
				<script type="text/javascript" language="javascript">
					alert("Foto Berhasil DI upload");
				</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/tambahfoto'>";
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function hapusfoto()
	{
		$id='';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id=$id;
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data = array();
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
		$pecah=explode("|",$session);
		$data["username"]=$pecah[0];
		$data["nama"]=$pecah[1];
		$data["status"]=$pecah[2];
	   	$data['scriptmce'] = $this->scripttiny_mce();
			if($data["status"]=="administrator"){
			$this->Webadmin_model->Delete_Content($id,"id_foto","tbl_galeri");
	   		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/tambahfoto'>";
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
		alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
		</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
	}
	
	function upload()
	{
		$page=$this->uri->segment(3);
      	$limit=12;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$data = array();
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["tanggal"] = mdate($datestring, $time);
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
		$pecah=explode("|",$session);
		$data["type"] = "Upload Berkas";
		$data["username"]=$pecah[0];
		$data["nama"]=$pecah[1];
		$data["status"]=$pecah[2];
		$data["page"]=$page;
	   	$data['scriptmce'] = $this->scripttiny_mce();
			if($data["status"]=="administrator"){
			$total = $this->Webadmin_model->Total_Data("tbl_media");
			$config['base_url'] = base_url() . '/index.php/webadmin/upload/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Daftar_File($offset,$limit);
			$this->load->view('webadmin/bg_atas',$data);
			$this->load->view('webadmin/bg_menu');
			$this->load->view('webadmin/upload',$data);
			$this->load->view('webadmin/bg_bawah');
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
		}
	}
	
	
	function tambahfile()
	{
		$page=$this->uri->segment(3);
      	$limit=10;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$data = array();
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["tanggal"] = mdate($datestring, $time);
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
		$pecah=explode("|",$session);
		$data["type"] = "Tambah Berita";
		$data["page"] = $page;
		$data["username"]=$pecah[0];
		$data["nama"]=$pecah[1];
		$data["status"]=$pecah[2];
	   	$data['scriptmce'] = $this->scripttiny_mce();
			if($data["status"]=="administrator"){
			$this->load->view('webadmin/bg_atas',$data);
			$this->load->view('webadmin/bg_menu');
			$this->load->view('webadmin/tambah_file',$data);
			$this->load->view('webadmin/bg_bawah');
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function guestbook()
	{
		$page=$this->uri->segment(3);
      	$limit=12;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		$data = array();
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["tanggal"] = mdate($datestring, $time);
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
		$pecah=explode("|",$session);
		$data["type"] = "Guestbook";
		$data["username"]=$pecah[0];
		$data["nama"]=$pecah[1];
		$data["status"]=$pecah[2];
		$data["page"]=$page;
	   	$data['scriptmce'] = $this->scripttiny_mce();
			if($data["status"]=="administrator"){
			$total = $this->Webadmin_model->Total_Data("tbl_guestbook");
			$config['base_url'] = base_url() . '/index.php/webadmin/guestbook/';
			$config['total_rows'] = $total->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$data['paginator'] = $this->pagination->create_links();
			$data['daftarartikel'] = $this->Webadmin_model->Guestbook($offset,$limit);
			$this->load->view('webadmin/bg_atas',$data);
			$this->load->view('webadmin/bg_menu');
			$this->load->view('webadmin/guestbook',$data);
			$this->load->view('webadmin/bg_bawah');
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
		}
	}
	
	function editguestbook()
	{
		$id='';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id=$id;
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data = array();
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data["tanggal"] = mdate($datestring, $time);
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
		$pecah=explode("|",$session);
		$data["username"]=$pecah[0];
		$data["nama"]=$pecah[1];
		$data["status"]=$pecah[2];
		$data["type"]="Polling";
	   	$data['scriptmce'] = $this->scripttiny_mce();
			if($data["status"]=="administrator"){
			$data["edit"] = $this->Webadmin_model->Edit_Content("tbl_guestbook","id=$id");
			$this->load->view('webadmin/bg_atas',$data);
			$this->load->view('webadmin/bg_menu');
			$this->load->view('webadmin/edit_guestbook',$data);
			$this->load->view('webadmin/bg_bawah');
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
		alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
		</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
	}
	
	function editkategori()
	{
		$id='';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id=$id;
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data = array();
		$datestring = "Login : %d-%m-%Y pukul %h:%i %a";
		$time = time();
		$data = array();
		$data["tanggal"] = mdate($datestring, $time);
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
		$pecah=explode("|",$session);
		$data["type"] = "Kategori Artikel";
		$data["username"]=$pecah[0];
		$data["nama"]=$pecah[1];
		$data["status"]=$pecah[2];
	   	$data['scriptmce'] = $this->scripttiny_mce();
			if($data["status"]=="administrator"){
			$data['detail'] = $this->Webadmin_model->Edit_Content("tbl_kategori_artikel","id_kat=$id");
			$this->load->view('webadmin/bg_atas',$data);
			$this->load->view('webadmin/bg_menu');
			$this->load->view('webadmin/edit_kategori',$data);
			$this->load->view('webadmin/bg_bawah');
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpanel'>";
		}
	}
	
	function updatekategori()
	{
		$data2 = array();
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
		$pecah=explode("|",$session);
		$data["username"]=$pecah[0];
		$data["nama"]=$pecah[1];
		$data["status"]=$pecah[2];
	   	$data['scriptmce'] = $this->scripttiny_mce();
			if($data["status"]=="administrator")
			{
				$data2['type']=$this->input->post('tipe');
				$data2['nama_kat']=$this->input->post('nama_kat');
				$data2['id_kat']=$this->input->post('id_kat');
				$this->Webadmin_model->Update_Content("tbl_kategori_artikel",$data2,"id_kat");
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/tambahkategori'>";
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
		alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
		</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
	}
	
	function updateguestbook()
	{
		$data = array();
		$data2 = array();
		$session=isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!=""){
		$pecah=explode("|",$session);
		$data['id_user'] = $pecah[3];
		$data['status'] = $pecah[2];
		$data['username'] = $pecah[0];
			if($data["status"]=="administrator"){
			$tgl = " %Y-%m-%d";
			$jam = "%h:%i:%a";
			$time = time();
			$data2["id"] = $this->input->post('id');
			$data2["nama"] = $this->input->post('nama');
			$data2["email"] = $this->input->post('email');
			$data2["pesan"] = $this->input->post('pesan');
			$data2["status"] = $this->input->post('status');
			$data['scriptmce'] = $this->scripttiny_mce();
			$this->Webadmin_model->Update_Content("tbl_guestbook",$data2,"id");
	   		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/guestbook'>";
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
				alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
			</script>
		<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/loginpage'>";
		}
	}
	
	function hapusguestbook() 
	{
		$id='';
		if ($this->uri->segment(3) === FALSE)
		{
    			$id=$id;
		}
		else
		{
    			$id = $this->uri->segment(3);
		}
		$data 					= array();
		$session				= isset($_SESSION['username_belajar']) ? $_SESSION['username_belajar']:'';
		if($session!="")
		{
			$pecah=explode("|",$session);
			$data["username"]	= $pecah[0];
			$data["nama"]		= $pecah[1];
			$data["status"]		= $pecah[2];
			$data['scriptmce'] = $this->scripttiny_mce();
			if($data["status"]=="administrator"){
			$this->Webadmin_model->Delete_Content($id,"id","tbl_guestbook");
	   		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/webadmin/guestbook'>";
			}
			else{
			?>
			<script type="text/javascript" language="javascript">
			alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
			</script>
			<?php
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
		}
		else{
			?>
			<script type="text/javascript" language="javascript">
		alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
		</script>
		<?php
		echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/'>";
			}
	}
	
	
	
//Function TinyMce------------------------------------------------------------------
		private function scripttiny_mce() {
		return '
<!-- TinyMCE -->
<script type="text/javascript" src="'.base_url().'jscripts/tiny_mce/tiny_mce_src.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		//content_css : "'.base_url().'system/application/views/themes/css/BrightSide.css",

		// Drop lists for link/image/media/template dialogs
		//"'.base_url().'media/lists/image_list.js"
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "'.base_url().'index.php/webadmin/image_list/",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : \'Bold text\', inline : \'b\'},
			{title : \'Red text\', inline : \'span\', styles : {color : \'#ff0000\'}},
			{title : \'Red header\', block : \'h1\', styles : {color : \'#ff0000\'}},
			{title : \'Example 1\', inline : \'span\', classes : \'example1\'},
			{title : \'Example 2\', inline : \'span\', classes : \'example2\'},
			{title : \'Table styles\'},
			{title : \'Table row 1\', selector : \'tr\', classes : \'tablerow1\'}
		],
		//disabled relative urls
		relative_urls : false,
		
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>';	
	}
}	
?>