<?php 

class Colaboradores extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('colaboradores_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    public function index()
    {
        $data['colaboradores'] = $this->colaboradores_model->get_colaboradores();
        $this->load->view('templates/header', array('title'=> 'Colaboradores'));
        $this->load->view('colaboradores/index', $data);
        $this->load->view('templates/footer');
    }

    public function create(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Criar um novo colaborador';
        $msgArr =  array('required' => 'Preencha o campo (%s).', 
        'is_unique' => 'O campo (%s) deve conter um valor exclusivo.',
        'min_length' => 'O campo (%s) deve ter no mínimo %d caracteres.',
        'max_length' => 'O campo (%s) deve ter no máximo %d caracteres.',
        'valid_email' => 'O campo (%s) deve conter um endereço de e-mail válido.',
        'integer' => 'O campo (%s) deve conter um número inteiro.');
        $this->form_validation->set_rules('usuario', 'Usuário', 'trim|required|max_length[16]|is_unique[colaboradores.usuario]',  $msgArr);
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[8]|max_length[16]',  $msgArr);
        $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[2]|max_length[16]',  $msgArr);
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|max_length[32]', $msgArr);
        $this->form_validation->set_rules('status', 'Status', 'required|integer',  $msgArr); 
        $this->form_validation->set_rules('tipo', 'Tipo', 'required|integer',  $msgArr); 
        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('colaboradores/create');
        }
        else
        {
            $this->colaboradores_model->set_colaboradores();
            $this->load->view('colaboradores/success', array('message' => 'Usuário criado com sucesso.'));
            $this->load->view('colaboradores/create');
        }
        $this->load->view('templates/footer');
    }

    public function update($id = NULL)
    {
        if (empty($this->colaboradores_model->get_colaborador($id))) redirect('colaboradores/index');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $msgArr =  array('required' => 'Preencha o campo (%s).', 
        'is_unique' => 'O campo (%s) deve conter um valor exclusivo.',
        'min_length' => 'O campo (%s) deve ter no mínimo %d caracteres.',
        'valid_email' => 'O campo (%s) deve conter um endereço de e-mail válido.',
        'integer' => 'O campo (%s) deve conter um número inteiro.');
        $this->form_validation->set_rules('tipo', 'Tipo', 'required|integer',  $msgArr); 
        $this->form_validation->set_rules('status', 'Status', 'required|integer',  $msgArr); 
        //$this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[2]',  $msgArr); 
        //$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email',  $msgArr); 
        $data["colaboradores"] = $this->colaboradores_model->get_colaborador($id);
        if(empty($data['colaboradores']))
        {
            show_404();
        }
        $this->load->view('templates/header', array('title' => 'Atualizar colaborador'));
        if ($this->form_validation->run() === FALSE)
        {
            //$this->load->view('colaboradores/update', $data);
        }
        else
        {
            $colaborador_ID = $this->session->userdata('id');
            $tipo = $this->session->userdata('tipo');
            if ($colaborador_ID == $id || $tipo == 2)
            {
                $this->colaboradores_model->update_colaborador($id);
                $this->load->view('colaboradores/success', array('message' => 'Atualização realizado com sucesso.'));
            }
            else
            {
                $this->load->view('colaboradores/warning', array('message' => 'VocÊ não é usuário dessa conta.'));
            }
        }
        $this->load->view('colaboradores/update', $data);
        $this->load->view('templates/footer');
    }
}