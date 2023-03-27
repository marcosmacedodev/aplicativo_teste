<?php
class Fornecedores_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_fornecedor($id)
    {
        $query = $this->db->get_where('fornecedores', array('fornecedor_ID' => $id));
        return $query->row_array();
    }

    public function get_fornecedores()
    {
        $query = $this->db->get('fornecedores');
        return $query->result_array();
    }

    public function get_fornecedores_ativos(){
        $this->db->where('status', 1);
        $query = $this->db->get('fornecedores');
        return $query->result_array();
    }

    public function set_fornecedores()
    {
        $this->load->helper('url');
        $colaborador_ID = $this->session->userdata('id');
        $data = array(
            'cnpj' => $this->input->post('cnpj'),
            'razao_social' => $this->input->post('razao_social'),
            'nome_fantasia' => $this->input->post('nome_fantasia'),
            'contato' => $this->input->post('contato'),
            'colaborador_ID' => $colaborador_ID,
            'status' => $this->input->post('status'),
            'atividade' => $this->input->post('atividade'),
            'descricao' => $this->input->post('descricao')
        );
        $this->db->insert('fornecedores', $data);
        return $this->db->insert_id();
    }

    public function update_fornecedor($id = NULL)
    {
        $this->load->helper('url');
        $data = array(
            'razao_social' => $this->input->post('razao_social'),
            'nome_fantasia' => $this->input->post('nome_fantasia'),
            'contato' => $this->input->post('contato'),
            'status' => $this->input->post('status'),
            'atividade' => $this->input->post('descricao'),
            'descricao' => $this->input->post('descricao')
        );
        return $this->db->update('fornecedores',  $data, array('fornecedor_ID' => $id));
    }
}