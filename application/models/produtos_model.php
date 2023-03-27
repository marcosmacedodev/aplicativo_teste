<?php
class Produtos_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_produto($id)
    {
        $query = $this->db->get_where('produtos', array('produto_ID' => $id));
        return $query->row_array();
    }

    public function get_produtos()
    {
        $query = $this->db->get('produtos');
        return $query->result_array();
    }

    public function set_produtos()
    {
        $this->load->helper('url');
        $data = array(
            'produto_nome' => $this->input->post('nome'),
            'preco' => $this->input->post('preco'),
            'estoque' => $this->input->post('estoque'),
            'status' => $this->input->post('status'),
            'descricao' => $this->input->post('descricao'),
            'colaborador_ID' => $this->session->userdata('id'),
            'fornecedor_ID' => $this->input->post('fornecedor')
        );
        $this->db->insert('produtos', $data);
        return $this->db->insert_id();
    }

    public function get_prod_por_forn($id)
    {
        $this->db->where('status', 1);
        $this->db->where('fornecedor_ID', $id);
        $query = $this->db->get('produtos');
        return $query->result_array();
    }

    public function update_produtos($id)
    {
        $this->load->helper('url');
        $data = array(
            'produto_nome' => $this->input->post('nome'),
            'preco' => $this->input->post('preco'),
            'estoque' => $this->input->post('estoque'),
            'descricao' => $this->input->post('descricao'),
            'status' => $this->input->post('status')
        );
        $this->db->update('produtos', $data, array('produto_ID' => $id));
    }
}