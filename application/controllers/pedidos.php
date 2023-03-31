<?php
class Pedidos extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('pedidos_model');
        $this->load->helper('url_helper');
        $this->load->library('session');
    }

    public function index()
    {
        $data['pedidos'] = $this->pedidos_model->get_pedidos();
        $this->load->view('templates/header', array('title' => 'Pedidos'));
        $this->load->view('pedidos/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('fornecedores_model');
        $data['fornecedores'] = $this->fornecedores_model->get_fornecedores_ativos();
        $data['title'] = 'Criar um novo pedido';
        $msgarr = array('required' => 'Preencha o campo (%s).',
        'is_unique' => 'O campo (%s) deve conter um valor exclusivo.',
        'greater_than_equal_to' => 'O campo (%s) deve conter um número maior ou igual a %d.',
        'integer' => 'O campo (%s) deve conter um número inteiro.',
        'max_length' => 'O campo (%s) deve ter no máximo %d caracteres.'
        );
        $this->form_validation->set_rules('num_pedido', 'Número do pedido', 'trim|required|max_length[8]|is_unique[pedidos.num_pedido]', $msgarr);
        $this->form_validation->set_rules('fornecedor_ID', 'Fornecedor', 'required|integer', $msgarr);
        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('pedidos/create');
        }
        else
        {
            if($this->session->userdata('status') == 0)
            {
                $this->load->view('pedidos/warning', array(
                    'message' => "Voc&ecirc; n&atilde;o tem permiss&atilde;o para esse tipo de fun&ccedil;&atilde;o"
                ));
            }
            else
            {
                $pedido_ID = $this->pedidos_model->set_pedidos();
                redirect('pedidos/update/' .$pedido_ID);
            }
        }
        $this->load->view('templates/footer');
    }

    public function update($id = NULL)
    {
        if(empty($this->pedidos_model->get_pedido($id))) redirect('pedidos/index');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('produtos_model');
        $this->load->model('fornecedores_model');
        $pedido = $this->pedidos_model->get_pedido($id);
        $data['pedidos'] = $pedido;
        $data['itens'] = $this->pedidos_model->get_itens($id);
        $data['produtos'] = $this->produtos_model->get_prod_por_forn($pedido['fornecedor_ID']);
        $data['razao_social'] = $this->fornecedores_model->get_fornecedor($pedido['fornecedor_ID'])['razao_social'];
        $data['title'] = 'Atualizar pedido';
        $msgarr = array('required' => 'Preencha o campo (%s).',
        'integer' => 'O campo (%s) deve conter um número inteiro.');
        $this->form_validation->set_rules('status', 'Status', 'required|integer', $msgarr);
        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {
            //$this->load->view('pedidos/update', $data);
        }
        else
        {
            $itens = $this->pedidos_model->get_itens_por_pedidos($id);
            $status = $this->input->post('status');
            $colaborador_ID = $this->session->userdata('id');
            $pedido = $this->pedidos_model->get__pedido($id, $colaborador_ID);
            if($this->session->userdata('status') == 0)
            {
                $this->load->view('pedidos/warning', array(
                    'message' => "Voc&ecirc; n&atilde;o tem permiss&atilde;o para esse tipo de fun&ccedil;&atilde;o"
                ));
            }
            elseif ($status == 0 and empty($itens))
            {
                $this->load->view('pedidos/warning', array(
                    'message' => "N&atilde;o é poss&iacute;vel finalizar o pedido ({$id}). Deve haver ao menos um item vinculado ao pedido."
                ));

            }
            elseif (empty($pedido)){
                $this->load->view('pedidos/warning', array(
                    'message' => "O pedido ({$id}) não está sob sua responsabilidade."
                ));

            }
            else
            {
                $this->pedidos_model->update_pedidos($id);
                $this->load->view('pedidos/success', array('message' => 'Pedido atualizado com sucesso.'));
            }
        }
        $this->load->view('pedidos/update', $data); 
        $this->load->view('pedidos/itens', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id){
        $itens = $this->pedidos_model->get_itens_por_pedidos($id);
        $colaborador_ID = $this->session->userdata('id');
        $pedidos = $this->pedidos_model->get__pedido($id, $colaborador_ID);
        if($this->session->userdata('status') == 0)
        {
            $this->index();
            $this->load->view('pedidos/warning', array(
                'message' => "Voc&ecirc; n&atilde;o tem permiss&atilde;o para esse tipo de fun&ccedil;&atilde;o"
            ));
            return;
        }
        if (!empty($itens))
        {
            $this->index();
            $this->load->view('pedidos/warning', array(
                'message' => "Não é possível remover o pedido ({$id}). Existe(m) item(ns) associado(s) a este pedido."
            ));
            return;
        }
        if (empty($pedidos))
        {
            $this->index();
            $this->load->view('pedidos/warning', array(
                'message' => "O pedido ({$id}) não está sob sua responsabilidade."
            ));
            return;
        }
        $this->pedidos_model->delete_pedido($id);
        redirect('pedidos/index');
    }

    public function get_itens_por_pedido($pedido_ID)
    {
        $this->db->where('pedido_ID', $pedido_ID);
        $query = $this->db->get('items');
        return $query->result_array();
    }

    public function get_item($id)
    {
        $this->db->where('item_ID', $id);
        $query = $this->db->get('items');
        return $query->row_array();
    }

    public function delete_item($id)
    {
        if($this->session->userdata('status') == 0)
        {
            $this->load->view('templates/header', array('title' => ''));
            $this->load->view('pedidos/warning', array(
                'message' => "Voc&ecirc; n&atilde;o tem permiss&atilde;o para esse tipo de fun&ccedil;&atilde;o"
            ));
        }
        else
        {
            $item = $this->get_item($id);
            $this->pedidos_model->delete_item($id);
            redirect('pedidos/update/' . $item['pedido_ID']);
        }
    }

    public function update_item($id)
    {
        if($this->session->userdata('status') == 0)
        {
            $this->load->view('templates/header', array('title' => ''));
            $this->load->view('pedidos/warning', array(
                'message' => "Voc&ecirc; n&atilde;o tem permiss&atilde;o para esse tipo de fun&ccedil;&atilde;o"
            ));
        }
        else
        {
            $item = $this->get_item($id);
            $this->pedidos_model->update_item($id);
            redirect('pedidos/update/' . $item['pedido_ID']);
        }
    }

    public function create_item($pedido_ID)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $msgarr = array('required' => 'Preencha o campo (%s).');
        $this->form_validation->set_rules('produto_ID', 'Produto', 'required', $msgarr);
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'required', $msgarr);
        $this->form_validation->set_rules('valor_unitario', 'Quantidade', 'required', $msgarr);

        if ($this->form_validation->run() === FALSE)
        {
            redirect('pedidos/update/'.$pedido_ID);
        }
        else
        {
            if($this->session->userdata('status') == 0)
            {
                $this->load->view('templates/header', array('title' => ''));
                $this->load->view('pedidos/warning', array(
                    'message' => "Voc&ecirc; n&atilde;o tem permiss&atilde;o para esse tipo de fun&ccedil;&atilde;o"
                ));
            }
            else
            {
                $this->pedidos_model->adicionar_item($pedido_ID);
                redirect('pedidos/update/'.$pedido_ID);
            }
        }
    }

    public function pedidos_finalizados($id = FALSE)
    {
        $this->load->model('fornecedores_model');
        $this->load->model('colaboradores_model');
        $data = array();
        $pedidos = $this->pedidos_model->get_pedidos_finalizados($id);
        foreach($pedidos as $pedido)
        {
            $pedido['fornecedor'] = $this->fornecedores_model->get_fornecedor($pedido['fornecedor_ID']);
            $pedido['colaborador'] = $this->colaboradores_model->get_colaborador($pedido['colaborador_ID']);
            $pedido['itens'] = $this->get_itens_por_pedido($pedido['pedido_ID']);
            $data[] = $pedido;
        }
        header('Content-Type: application/json');
        echo json_encode( array('pedidos' => $data) );
    }
}