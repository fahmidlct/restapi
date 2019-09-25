<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    var $key = 'asdf';

    public function __construct() {
        parent::__construct();
        $this->load->model('Api_model', 'api');
    }

    public function cek() {
        if($this->key == 'asdf') {
            return true;
        }
        else {
            return false;
        }
    }

    public function invalid_key() {
        $response['status'] = false;
        $response['code'] = 0;
        $response['message'] = 'Invalid API Key';

        echo json_encode($response);
    }

    public function show($id = null) {
        $response = [];

        if($this->cek() == false) {
            $this->invalid_key();
        }
        else {
            if(empty($id)) {
                $data = $this->api->show();

                $response['status'] = true;
                $response['code'] = 200;
                $response['message'] = "Data tersedia";
                $response['data'] = [];
                
                foreach($data as $row) {
                    $response['data'][] = ['id' => $row['id'], 'nama' => $row['nama'], 'alamat' => $row['alamat']];
                }
            }
            else {
                $cek_data = $this->api->cek($id);
                if($cek_data) {
                    $data = $this->api->resultRow($id);
                    $response['status'] = true;
                    $response['code'] = 200;
                    $response['message'] = "Data tersedia";
                    $response['data']['id'] = $data['id'];
                    $response['data']['nama'] = $data['nama'];
                    $response['data']['alamat'] = $data['alamat'];
                }
                else {
                    $response['status'] = false;
                    $response['code'] = 500;
                    $response['message'] = 'Data tidak ditemukan';
                }
            }
        }
        echo json_encode($response);
    }

    public function add() {
        $response = [];

        if($this->cek() == false) {
            $this->invalid_key();
        }
        else {
            $tambah = $this->api->add();
            if($tambah) {
                $response['status'] = true;
                $response['code'] = 200;
                $response['message'] = "Data berhasil ditambah";
            }
            else {
                $response['status'] = false;
                $response['code'] = 500;
                $response['message'] = 'Gagal menambah data';
            }
        }
        echo json_encode($response);
    }

    public function delete($id) {
        $response = [];

        if($this->cek() == false) {
            $this->invalid_key();
        }
        else {
            if(!empty($id)) {
                $cek_data = $this->api->cek($id);
                
                if($cek_data) {
                    $hapus = $this->api->delete($id);
                    
                    if($hapus) {
                        $response['status'] = true;
                        $response['code'] = 200;
                        $response['message'] = "Data berhasil dihapus";
                    }
                    else {
                        $response['status'] = false;
                        $response['code'] = 500;
                        $response['message'] = "Data gagal dihapus";
                    }
                }
                else {
                    $response['status'] = false;
                    $response['code'] = 500;
                    $response['message'] = "Data tidak ditemukan";
                }
            }
        }
        echo json_encode($response);
    }

    public function update($id) {
        $response = [];

        if($this->cek() == false) {
            $this->invalid_key();
        }
        else {
            if(!empty($id)) {
                $cek_data = $this->api->cek($id);
                if($cek_data) {
                    $edit = $this->api->edit($id);

                    if($edit) {
                        $response['status'] = true;
                        $response['code'] = 200;
                        $response['message'] = "Data berhasil diedit";
                    }
                    else {
                        $response['status'] = false;
                        $response['code'] = 500;
                        $response['message'] = "Data gagal diedit";
                    }  
                }
                else {
                    $response['status'] = false;
                    $response['code'] = 500;
                    $response['message'] = "Data tidak ditemukan";
                }
            }
        }
        echo json_encode($response);
    }
    // public function show() {

    //     $response = [];

    //     if($this->cek() === false) {
    //         $this->invalid_key();
    //     }
    //     else {
    //         $query = $this->api->show();
            
    //         $response['code'] = 1;
    //         $response['message'] = 'Data oke';
    //         $response['data'] = [];

    //         foreach($query as $row) {
    //             $response['data'][] = ['id' => $row['id'], 'nama' => $row['nama'], 'alamat' => $row['alamat']];
    //         }
            
    //         echo json_encode($response);
    //     }
    // }

    // public function row($id = null) {
        
    //     $response = [];

    //     if($this->cek() === false) {
    //         $this->invalid_key();
    //     }
    //     else {
    //         if($id == null) {
    //             redirect('user');
    //         }
    //         else {
    //             $id = $this->uri->segment(2);
                
    //             $cek = $this->api->row($id);

    //             if($cek) {
    //                 $row = $this->api->resultRow($id);

    //                 $response['code'] = 1;
    //                 $response['message'] = 'Oke';
    //                 $response['data'] = [];
    //                 $response['data']['id'] = $row['id'];
    //                 $response['data']['nama'] = $row['nama'];
    //                 $response['data']['alamat'] = $row['alamat'];
    //             }
    //             else {
    //                 $response['code'] = 0;
    //                 $response['message'] = 'Data tidak ditemukan';
    //             }
    //         }

    //         echo json_encode($response);
    //     }
        
    // }

    // public function delete($id) {
    //     $response = [];

    //     if($this->cek() === false) {
    //         $this->invalid_key();
    //     }
    //     else {
    //         if($id == null) {
    //             redirect('user');
    //         }
    //         else {
    //             $id = $this->uri->segment(2);
                
    //             $cek = $this->api->row($id);

    //             if($cek) {
    //                 $hapus = $this->api->delete($id);

    //                 if($hapus) {

    //                     $response['code'] = 1;
    //                     $response['message'] = 'Data berhasil terhapus';
    //                 }
    //                 else {
    //                     $response['code'] = 0;
    //                     $response['message'] = 'Data gagal ditemukan';
    //                 }
    //             }
    //             else {
    //                 $response['code'] = 0;
    //                 $response['message'] = 'Data tidak ditemukan';
    //             }

    //         }
    //     }

    //     echo json_encode($response);

    // }

    // public function add() {
    //     $response = [];

    //     if($this->cek() === false) {
    //         $this->invalid_key();
    //     }
    //     else {
    //         if($this->api->add()) {
    //             $response['code'] = 1;
    //             $response['message'] = 'Data berhasil ditambah';
    //         }
    //         else {
    //             $response['code'] = 0;
    //             $response['message'] = 'Data gagal ditambah';
    //         }
    //     }

    //     echo json_encode($response);
    // }

    // public function edit() {
    //     $response = [];
    //     $id = $this->input->post('id');

    //     if($this->cek() === false) {
    //         $this->invalid_key();
    //     }
    //     else {
    //         //$id = $this->uri->segment(2);
                
    //         $cek = $this->api->row($id);

    //         if($cek) {
    //         $edit = $this->api->edit();
    //             if($edit) {
    //                 $response['code'] = 1;
    //                 $response['message'] = 'Data berhasil diedit';
    //             }
    //             else {
    //                 $response['code'] = 0;
    //                 $response['message'] = 'Data gagal diedit';
    //             }
    //         }
    //         else {
    //             $response['code'] = 0;
    //             $response['message'] = 'Data tidak ditemukan';
    //         }
    //     }
    //     echo json_encode($response);
    // }

}
