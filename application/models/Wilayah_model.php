<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Ambil semua provinsi
    public function get_provinces() {
        return $this->db->get('reg_provinces')->result();
    }

    // Ambil kabupaten berdasarkan provinsi
    public function get_regencies($province_id) {
        return $this->db->where('province_id', $province_id)
                        ->get('reg_regencies')
                        ->result();
    }

    // Ambil kecamatan berdasarkan kabupaten
    public function get_districts($regency_id) {
        return $this->db->where('regency_id', $regency_id)
                        ->get('reg_districts')
                        ->result();
    }

    // Ambil desa berdasarkan kecamatan
    public function get_villages($district_id) {
        return $this->db->where('district_id', $district_id)
                        ->get('reg_villages')
                        ->result();
    }

    // Hitung semua data wilayah
    public function count_all_wilayah() {
        return $this->db->count_all('reg_provinces');
    }

    // Ambil data untuk datatable dengan filter
    public function get_wilayah_datatable($start, $length, $search, $order, $province = null, $regency = null, $district = null, $village = null) {
        $this->db->select('p.id as province_id, p.name as province_name, 
                          r.id as regency_id, r.name as regency_name,
                          d.id as district_id, d.name as district_name,
                          v.id as village_id, v.name as village_name');
        $this->db->from('reg_provinces p');
        $this->db->join('reg_regencies r', 'r.province_id = p.id', 'left');
        $this->db->join('reg_districts d', 'd.regency_id = r.id', 'left');
        $this->db->join('reg_villages v', 'v.district_id = d.id', 'left');
        
        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('p.name', $search);
            $this->db->or_like('r.name', $search);
            $this->db->or_like('d.name', $search);
            $this->db->or_like('v.name', $search);
            $this->db->group_end();
        }
        
        // Filter provinsi
        if (!empty($province)) {
            $this->db->where('p.id', $province);
        }
        
        // Filter kabupaten
        if (!empty($regency)) {
            $this->db->where('r.id', $regency);
        }
        
        // Filter kecamatan
        if (!empty($district)) {
            $this->db->where('d.id', $district);
        }
        
        // Filter desa
        if (!empty($village)) {
            $this->db->where('v.id', $village);
        }
        
        // Ordering
        if (!empty($order)) {
            $columns = array(
                1 => 'p.name',
                2 => 'r.name',
                3 => 'd.name',
                4 => 'v.name'
            );
            $this->db->order_by($columns[$order[0]['column']], $order[0]['dir']);
        } else {
            $this->db->order_by('p.name, r.name, d.name, v.name');
        }
        
        // Limit untuk pagination
        $this->db->limit($length, $start);
        
        return $this->db->get()->result();
    }

    // Hitung data yang difilter
    public function count_filtered_wilayah($search, $province = null, $regency = null, $district = null, $village = null) {
        $this->db->from('reg_provinces p');
        $this->db->join('reg_regencies r', 'r.province_id = p.id', 'left');
        $this->db->join('reg_districts d', 'd.regency_id = r.id', 'left');
        $this->db->join('reg_villages v', 'v.district_id = d.id', 'left');
        
        // Filter pencarian
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('p.name', $search);
            $this->db->or_like('r.name', $search);
            $this->db->or_like('d.name', $search);
            $this->db->or_like('v.name', $search);
            $this->db->group_end();
        }
        
        // Filter provinsi
        if (!empty($province)) {
            $this->db->where('p.id', $province);
        }
        
        // Filter kabupaten
        if (!empty($regency)) {
            $this->db->where('r.id', $regency);
        }
        
        // Filter kecamatan
        if (!empty($district)) {
            $this->db->where('d.id', $district);
        }
        
        // Filter desa
        if (!empty($village)) {
            $this->db->where('v.id', $village);
        }
        
        return $this->db->count_all_results();
    }
}