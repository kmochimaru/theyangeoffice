<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Register_model
 *
 * @author nut
 */
class Register_model extends CI_Model{
    //put your code here
    public function getusertel($tel = null) {
        $this->db->select('*');
        if ($tel != NULL) {
            $this->db->where('user.user_tel', $tel);
        }
        return $this->db->get('user');
    }
    
    public function checkUsername($username = null) {
        $this->db->select('username');
        $this->db->where('username', $username);
        $this->db->limit(1);
        return $this->db->get('user')->num_rows();
    }
    
    public function checkEmail($email) {
        $this->db->select('user_email');
        $this->db->where('user_email', $email);
        $this->db->limit(1);
        return $this->db->get('user')->num_rows();
    }
    
    public function addUser($data) {
        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }
    
    public function addShop($data) {
        $this->db->insert('shop', $data);
        return $this->db->insert_id();
    }
    
    public function editShop($id, $data) {
        $this->db->where('shop.shop_id_pri', $id);
        $this->db->update('shop', $data);
    }
    
    public function getShopid($shop_id) {
        $this->db->select('*');
        $this->db->from('shop');
        $this->db->where('shop.shop_id', $shop_id);
        $this->db->limit(1);
        return $this->db->get()->row()->shop_id_pri;
    }
}
