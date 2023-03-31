<?php
class Login extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('login_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    public function index(){
        $this->load->view('login');
    }

    public function autenticar()
    {
        if($this->session->userdata('ip_blocked_time') && 
        $this->session->userdata('ip_blocked_time') > time())
        {
            redirect('login');
        } 
        $this->load->helper('url');
        $usuario = $this->input->post('usuario');
        $senha = $this->input->post('senha');
        $resultado = $this->login_model->validar_usuario($usuario, $senha);
        if ($resultado)
        {
            switch($resultado->status)
            {
                case 2: 
                    $this->session->set_flashdata('erro_login', 'Sua conta está bloqueada! Contate o Administrador');
                    redirect('login');
                case 0:
                case 1: 
                    $data = array(
                    'usuario' => $resultado->usuario,
                    'id' => $resultado->colaborador_ID,
                    'tipo' => $resultado->tipo,
                    'nome' => $resultado->nome,
                    'sobrenome' => $resultado->sobrenome,
                    'logged_in' => true
                );
                $this->session->set_userdata($data);
                $this->session->set_userdata('login_tentativas', 0);
                redirect('pedidos');
            }
        }
        else
        {
            $this->session->set_flashdata('erro_login', 'Usuário ou senha inválidos');
            redirect('login');
        }
    }

    public function alterar_senha()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $msgarr = array('required' => 'O campo (%s) é de preenchimento obrigatório.',
        'min_length' => 'O campo (%s) deve ter no mínimo %d caracteres.');

        $this->form_validation->set_rules('senha', 'Senha atual', 'required', $msgarr);
        $this->form_validation->set_rules('nova_senha1', 'Nova senha', 'required|min_length[8]', $msgarr);
        $this->form_validation->set_rules('nova_senha2', 'Confirmar nova senha', 'required|min_length[8]', $msgarr);
        $this->load->view('templates/header', array('title' => 'Alterar senha'));
    
        $usuario = $this->session->userdata('usuario');
        $senha = $this->input->post('senha');
        $nova_senha1 = $this->input->post('nova_senha1');
        $nova_senha2 = $this->input->post('nova_senha2');
        if ($this->form_validation->run() === FALSE)
        {

        }
        else
        {
            if (strcmp($nova_senha1, $nova_senha2) <> 0)
            {
                $this->load->view('warning', array('message' => 'Os campos de nova senha não coincidem. Tente novamente!'));
            }
            elseif (empty($this->login_model->validar_usuario($usuario, $senha)))
            {
                $this->load->view('warning', array('message' => 'Senha atual inválida. Tente novamente!'));
            }
            else
            {
                $colaborador_ID = $this->session->userdata('id');
                $this->login_model->alterar_senha($colaborador_ID, $usuario, $nova_senha1);
                $this->load->view('success', array('message' => 'Senha alterada com sucesso.'));
            }
        }
        $this->load->view('alterar_senha');
        $this->load->view('templates/footer');
    }

    public function sair(){
        $this->session->sess_destroy();
        redirect('login');
    }

}