<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Wilayah_model');
    }

    public function index() {
        $this->load->view('wilayah_view');
    }

    // AJAX function untuk datatable
    public function datatable() {
        $post = $this->input->post();
        
        $draw = $post['draw'];
        $start = $post['start'];
        $length = $post['length'];
        $search = $post['search']['value'];
        $order = $post['order'];
        
        // Ambil nilai filter
        $province = $this->input->post('province');
        $regency = $this->input->post('regency');
        $district = $this->input->post('district');
        $village = $this->input->post('village');
        
        $data = array(
            "draw" => $draw,
            "recordsTotal" => $this->Wilayah_model->count_all_wilayah(),
            "recordsFiltered" => $this->Wilayah_model->count_filtered_wilayah($search, $province, $regency, $district, $village),
            "data" => $this->Wilayah_model->get_wilayah_datatable($start, $length, $search, $order, $province, $regency, $district, $village)
        );
        
        echo json_encode($data);
    }

    // AJAX function untuk mendapatkan kabupaten
    public function get_regencies() {
        $province_id = $this->input->post('province_id');
        $regencies = $this->Wilayah_model->get_regencies($province_id);
        echo json_encode($regencies);
    }

    // AJAX function untuk mendapatkan kecamatan
    public function get_districts() {
        $regency_id = $this->input->post('regency_id');
        $districts = $this->Wilayah_model->get_districts($regency_id);
        echo json_encode($districts);
    }

    // AJAX function untuk mendapatkan desa
    public function get_villages() {
        $district_id = $this->input->post('district_id');
        $villages = $this->Wilayah_model->get_villages($district_id);
        echo json_encode($villages);
    }
}