<?php
class Pedidos_model extends CI_Model{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_pedido($id)
    {
        $query = $this->db->get_where('pedidos', array('pedido_ID' => $id));
        return $query->row_array();
    }

    public function get__pedido($id, $colaborador_ID)
    {
        $this->db->where('pedido_ID', $id);
        $this->db->where('colaborador_ID', $colaborador_ID);
        $query = $this->db->get('pedidos', array('pedido_ID' => $id));
        return $query->row_array();
    }

    public function get_pedidos()
    {
        $query = $this->db->get('pedidos');
        return $query->result_array();
    }

    public function get_pedidos_finalizados($id = FALSE)
    {
        if($id)
            $this->db->where('pedido_ID', $id);
        $this->db->where('status', 0);
        $query = $this->db->get('pedidos');
        return $query->result_array();
    }


    public function set_pedidos()
    {
        date_default_timezone_set('America/Sao_Paulo');
        $dataNow = date('Y-m-d');
        $this->load->helper('url');
        $colaborador_ID = $this->session->userdata('id');
        $data = array(
            'data' => $dataNow,
            'status' => 1,
            'observacao' => $this->input->post('observacao'),
            'num_pedido' => $this->input->post('num_pedido'),
            'colaborador_ID' => $colaborador_ID,
            'fornecedor_ID' => $this->input->post('fornecedor_ID')
        );
        $this->db->insert('pedidos', $data);
        return $this->db->insert_id();
    }

    public function get_itens($id)
    {
        $this->db->where('pedido_ID', $id);
        $query = $this->db->get('items');
        return $query->result_array();
    }

    public function get_produto($id){
        $this->db->where('produto_ID', $id);
        $query = $this->db->get('produtos');
        return $query->row_array();
    }

    public function update_pedidos($id = NULL)
    {
        $this->load->helper('url');
        $data = array(
            'status' => $this->input->post('status'),
            'observacao' => $this->input->post('observacao')
        );
        $this->db->update('pedidos', $data, array('pedido_ID' => $id));
    }

    public function delete_pedido($id)
    {
        $this->db->delete('pedidos', array('pedido_ID' => $id));
    }

    public function adicionar_item($pedido_ID){
        $this->load->helper('url');
        $produto_ID = $this->input->post('produto_ID');
        $quantidade = $this->input->post('quantidade');
        $valor_unitario = $this->input->post('valor_unitario');
        $produto_nome = $this->get_produto($produto_ID)['produto_nome'];
        $data = array(
            'produto_ID' => $produto_ID,
            'quantidade' => $quantidade,
            'valor_unitario' => $valor_unitario,
            'pedido_ID' => $pedido_ID,
            'nome_item' => $produto_nome
        );
        $this->db->insert('items', $data);
    }

    public function delete_item($id)
    {
        $this->db->where('item_ID', $id);
        $this->db->delete('items');
    }

    public function update_item($id)
    {
        $data = array(
            'quantidade' => $this->input->post('quantidade'),
            'valor_unitario' => $this->input->post('valor_unitario')
        );
        return $this->db->update('items', $data, array('item_ID' => $id));
    }

    public function get_itens_por_pedidos($pedido_ID)
    {
        $this->db->where('pedido_ID', $pedido_ID);
        $query = $this->db->get('items');
        return $query->result_array();
    }

}