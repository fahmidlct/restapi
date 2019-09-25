<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    //menampilkan semua data
    public function show() {
        $query = $this->db->get('user');
        return $query->result_array();
    }

    //cek apakah id tersedia didatabase
    public function cek($id) {
        $query = $this->db->get_where('user', ['id' => $id]);
        if($query->num_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    //menampilkan data berdasarkan id
    public function resultRow($id) {
        $query = $this->db->get_where('user', ['id' => $id]);
        return $query->row_array();
    }

    //menghapus data berdasarkan id
    public function delete($id) {
        $query = $this->db->delete('user', ['id' => $id]);
        if($this->db->affected_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    //menambah data
    public function add() {
        $data = array('id' => null, 'nama' => $this->input->post('nama', true), 'alamat' => $this->input->post('alamat', true));

        $query = $this->db->insert('user', $data);
        if($this->db->affected_rows() > 0) {
            return true;
        }
        else {
            return false;
        }

    }

    public function edit($id) {
        
        $data = array('nama' => $this->input->post('nama', true), 'alamat' => $this->input->post('alamat', true));

        $query = $this->db->update('user', $data, ['id' => $id]);
        if($this->db->affected_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }
}
