<?php
class Colaboradores_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_colaborador($id)
    {
        $query = $this->db->get_where('colaboradores', array('colaborador_ID' => $id));
        return $query->row_array();
    }

    public function get_colaboradores()
    {
        $query = $this->db->get('colaboradores');
        return $query->result_array();
    }

    public function set_colaboradores()
    {
        $this->load->helper('url');
        $data = array(
            'usuario' => $this->input->post('usuario'),
            'senha' => md5($this->input->post('senha')),
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'sobrenome' => $this->input->post('sobrenome'),
            'status' => $this->input->post('status'),
            'tipo' => $this->input->post('tipo')
        );
        $this->db->insert('colaboradores', $data);
        return $this->db->insert_id();
    }

    public function update_colaborador($id = FALSE)
    {
        $this->load->helper('url');
        $data = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'sobrenome' => $this->input->post('sobrenome'),
            'status' => $this->input->post('status'),
            'tipo' => $this->input->post('tipo')
        );
        return $this->db->update('colaboradores',  $data, array('colaborador_ID' => $id));
    }


}