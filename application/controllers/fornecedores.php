<?php 
class Fornecedores extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('fornecedores_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    public function index(){
        $data['fornecedores'] = $this->fornecedores_model->get_fornecedores();
        $this->load->view('templates/header', array('title' => 'Fornecedores'));
        $this->load->view('fornecedores/index', $data);
        $this->load->view('templates/footer');
    }

    public function create(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $msgArr =  array('required' => 'Preencha o campo (%s).', 
        'is_unique' => 'O campo (%s) deve conter um valor exclusivo.',
        'min_length' => 'O campo (%s) deve ter no mínimo %d caracteres.',
        'max_length' => 'O campo (%s) deve ter no máximo %d caracteres.',
        'valid_email' => 'O campo (%s) deve conter um endereço de e-mail válido.',
        'integer' => 'O campo (%s) deve conter um número inteiro.'
        );
        $this->form_validation->set_rules('cnpj', 'CNPJ', 'trim|required|max_length[14]|is_unique[fornecedores.cnpj]', $msgArr);
        $this->form_validation->set_rules('razao_social', 'Razão Social', 'trim|required|max_length[16]', $msgArr);
        $this->form_validation->set_rules('nome_fantasia', 'Nome fantasia', 'trim|required|max_length[16]', $msgArr);
        $this->form_validation->set_rules('contato', 'Contato', 'trim|required|max_length[16]', $msgArr);
        $this->form_validation->set_rules('atividade', 'Atividade', 'required|max_length[16]', $msgArr);
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim|required|max_length[32]', $msgArr);
        $this->form_validation->set_rules('status', 'Status', 'required|integer', $msgArr);
        $data['fornecedores'] = array();
        $this->load->view('templates/header', array('title' => 'Fornecedores'));
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('fornecedores/create');
        }
        else
        {
            $this->fornecedores_model->set_fornecedores();
            $this->load->view('fornecedores/success', array('message' => 'Fornecedor criado com sucesso.'));
            $this->load->view('fornecedores/create');
        }
        $this->load->view('templates/footer');
    }

    public function update($id = NULL){
        if (empty($this->fornecedores_model->get_fornecedor($id))) redirect('fornecedores/index');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $msgArr =  array('required' => 'Preencha o campo (%s).', 
        // 'is_unique' => 'O campo (%s) deve conter um valor exclusivo.',
        'min_length' => 'O campo (%s) deve ter no mínimo %d caracteres.',
        'max_length' => 'O campo (%s) deve ter no máximo %d caracteres.',
        'valid_email' => 'O campo (%s) deve conter um endereço de e-mail válido.',
        'integer' => 'O campo (%s) deve conter um número inteiro.');
        $this->form_validation->set_rules('razao_social', 'Razão social', 'trim|required|max_length[16]', $msgArr);
        $this->form_validation->set_rules('nome_fantasia', 'Nome fantasia', 'trim|required|max_length[16]', $msgArr);
        $this->form_validation->set_rules('contato', 'Contato', 'trim|required|max_length[16]', $msgArr);
        $this->form_validation->set_rules('atividade', 'Atividade', 'trim|required|max_length[16]', $msgArr);
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim|required|max_length[32]', $msgArr);
        $this->form_validation->set_rules('status', 'Status', 'required|integer', $msgArr);
        $data['title'] = 'Atualização';
        $data['fornecedores'] = $this->fornecedores_model->get_fornecedor($id);
        $this->load->view('templates/header', array('title' => 'Fornecedores'));
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('fornecedores/update', $data);
        }
        else
        {
            $this->fornecedores_model->update_fornecedor($id);
            $this->load->view('fornecedores/success', array('message' => 'Atualização realizado com sucesso.'));
            $this->load->view('fornecedores/update', $data);
        }
        $this->load->view('templates/footer');
    }
}