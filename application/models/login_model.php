<?php
class Login_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }
    public function validar_usuario($usuario, $senha)
    {
        $this->db->where('usuario', $usuario);
        $this->db->where('senha', md5($senha));
        $query = $this->db->get('colaboradores');
        return $query->row();
    }

    public function alterar_senha($id, $usuario, $senha)
    {
        $this->db->update('colaboradores', array('senha' => md5($senha)), 
        array('colaborador_ID' => $id, 'usuario' => $usuario));
    }

    public function buscar_usuario($usuario){
        $this->db->where('usuario', $usuario);
        $query = $this->db->get('colaboradores');
        return $query->row();
    }
}