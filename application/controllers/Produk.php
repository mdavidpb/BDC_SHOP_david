<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login')!=TRUE) {
			redirect('admin/login','refresh');
		}
		$this->load->model('m_produk','produk');
	}

	public function index()
	{
		$data['tampil_produk']=$this->produk->tampil();
		$data['kategori']=$this->produk->data_kategori();
		$data['konten']="v_produk";
		$data['judul']="Daftar Produk";
		$this->load->view('template', $data);
	}
	public function toko()
	{
		$data['tampil_produk']=$this->produk->tampil();
		$data['kategori']=$this->produk->data_kategori();
		$data['konten']="toko";
		$data['judul']="BDC SHOP";
		$this->load->view('template', $data);
	}
	public function tambah()
	{
		$this->form_validation->set_rules('nama_produk', 'nama_produk', 'trim|required');
		$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim|required');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required');
		$this->form_validation->set_rules('pembuat', 'pembuat', 'trim|required');
		$this->form_validation->set_rules('pembeli', 'pembeli', 'trim|required');
		$this->form_validation->set_rules('stok', 'stok', 'trim|required');
		if ($this->form_validation->run()==TRUE) {
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']  = '1000';
			$config['max_width']  = '5000';
			$config['max_height']  = '5000';
			if ($_FILES['foto_cover']['name']!="") {
				$this->load->library('upload', $config);

				if (! $this->upload->do_upload('foto_cover')) {
					$this->session->set_flashdata('pesan', $this->upload->display_errors());
				}else {
					if ($this->produk->simpan_produk($this->upload->data('file_name'))) {
						$this->session->set_flashdata('pesan', 'Sukses menambah ');
					}else{
						$this->session->set_flashdata('pesan', 'Gagal menambah');
					}
					redirect('produk','refresh');
				}
			}else{
				if ($this->produk->simpan_produk('')) {
					$this->session->set_flashdata('pesan', 'Sukses menambah');
				}else{
					$this->session->set_flashdata('pesan', 'Gagal menambah');
				}
				redirect('produk','refresh');
			}

		}else{
			$this->session->set_flashdata('pesan', validation_errors());
			redirect('produk','refresh');
		}
	}
	public function edit_produk($id)
	{
		$data=$this->produk->detail($id);
		echo json_encode($data);
	}
	public function produk_update()
	{
		if($this->input->post('edit')){
			if($_FILES['foto_cover']['name']==""){
				if($this->produk->edit_produk()){
					$this->session->set_flashdata('pesan', 'Sukses update');
					redirect('produk');
				} else {
					$this->session->set_flashdata('pesan', 'Gagal update');
					redirect('produk');
				}
			} else {
				$config['upload_path'] = './assets/img/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']  = '20000';
				$config['max_width']  = '5024';
				$config['max_height']  = '5768';

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('foto_cover')){
					$this->session->set_flashdata('pesan', 'Gagal Upload');
					redirect('produk');
				}
				else{
					if($this->produk->edit_produk_dengan_foto($this->upload->data('file_name'))){
						$this->session->set_flashdata('pesan', 'Sukses update');
						redirect('produk');
					} else {
						$this->session->set_flashdata('pesan', 'Gagal update');
						redirect('produk');
					}
				}
			}

		}

	}
	public function hapus($id_produk='')
	{
		if ($this->produk->hapus_produk($id_produk)) {
			$this->session->set_flashdata('pesan', 'Sukses Hapus Produk');
			redirect('produk','refresh');
		}else{
			$this->session->set_flashdata('pesan', 'Gagal Hapus Produk');
			redirect('produk','refresh');
		}
	}

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */
