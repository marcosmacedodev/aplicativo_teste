<?php
class Produtos extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('produtos_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    public function index(){
        $usuario = $this->session->userdata('usuario');
        log_message('info', 'Solicitção "produtos/index" por: ' . $usuario);
        $data['produtos'] = $this->produtos_model->get_produtos();
        $this->load->view('templates/header', array('title' => 'Produtos'));
        $this->load->view('produtos/index', $data);
        $this->load->view('templates/footer');
    }

    public function create(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('fornecedores_model');
        $data['fornecedores'] = $this->fornecedores_model->get_fornecedores_ativos();
        $data['title'] = 'Criar um novo produto';
        $msgarr = array('required' => 'Preencha o campo (%s).',
        'max_length' => 'O campo (%s) deve ter no máximo %d caracteres.',
        'decimal' => 'O campo (%s) deve conter um número decimal',
        'integer' => 'O campo (%s) deve conter um número inteiro.');
        $this->form_validation->set_rules('fornecedor', 'Fornecedor', 'required|integer', $msgarr);
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[16]', $msgarr);
        $this->form_validation->set_rules('preco', 'Preço', 'trim|required|decimal', $msgarr);
        $this->form_validation->set_rules('estoque', 'Quantidade em estoque', 'required|integer', $msgarr);
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim|required|max_length[32]', $msgarr);
        $this->form_validation->set_rules('status', 'Status', 'required|integer', $msgarr);
        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('produtos/create', $data);
        }
        else
        {
            $id = $this->produtos_model->set_produtos();
            $this->load->view('produtos/success', array('message' => 'Produto criado com sucesso.'));
            $this->load->view('produtos/create');
        }
        $this->load->view('templates/footer');
    }

    public function update($id = NULL){
        if(empty($this->produtos_model->get_produto($id))) redirect('produtos/index');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Atualizar produto';
        $data['produtos'] = $this->produtos_model->get_produto($id);
        $msgarr = array('required' => 'Preencha o campo (%s).',
        'max_length' => 'O campo (%s) deve ter no máximo %d caracteres.',
        'decimal' => 'O campo (%s) deve conter um número decimal',
        'integer' => 'O campo (%s) deve conter um número inteiro.');
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|max_length[16]', $msgarr);
        $this->form_validation->set_rules('preco', 'Preço', 'trim|required|decimal', $msgarr);
        $this->form_validation->set_rules('estoque', 'Quantidade de estoque', 'required|integer', $msgarr);
        $this->form_validation->set_rules('descricao', 'Descrição', 'trim|required|max_length[32]', $msgarr);
        $this->form_validation->set_rules('status', 'Status', 'required|integer', $msgarr);
        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('produtos/update', $data);
        }
        else
        {
            $this->produtos_model->update_produtos($id);
            $this->load->view('produtos/success', array('message' => 'Produto atualizado criado com sucesso.'));
            $this->load->view('produtos/update');  
        }
        $this->load->view('templates/footer');
    }
}