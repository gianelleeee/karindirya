<?php
class Products extends CI_Controller{

    public function __construct()
    {
        //never load libraries or models in here.
        parent::__construct();
    }

    public function index(){

        //load helpers
        $this->load->helper(array('form', 'url'));

        $data['title'] = "Add Product";
        $this->load->view('include/header_view', $data);
		$this->load->view('add_product_view');
		$this->load->view('include/footer_view');
    }

    public function processAddProduct(){

         //load helpers
         $this->load->helper(array('form', 'url'));
         //includes the form validation library.
        $this->load->library('form_validation');
        $this->load->database();
        $this->form_validation->set_rules('prod_name', 'Product Name', 'required|is_unique[tblproducts.prod_name]', array('is_unique' => 'Product name already exist'));
        $this->form_validation->set_rules('prod_description', 'Product Description', 'required');
        $this->form_validation->set_rules('prod_price', 'Product Price', 'required|numeric');

        //run form validation
        if ($this->form_validation->run() == FALSE){
            $this->index();
        }else {

            $data = array(
                'prod_name' => $this->input->post('prod_name'),
                'prod_description' => $this->input->post('prod_description'),
                'prod_price' => $this->input->post('prod_price')
            );

            //loads the product model
            $this->load->model('Products_model');
            $this->Products_model->saveProduct($data);
            redirect('home/view_products');
        }

    }

    public function editProduct($id)
    {
        $this->load->helper(array('form', 'url'));
        //load the product model
        $this->load->model('Products_model');
        //fetch the product using the id provided in the parameter
        $data['product'] = $this->Products_model->getProduct($id);
         $data['title'] = "Edit Product";
        
         //for checking if the view is edit or view item
         $data['edit'] = true;
         $this->load->view('include/header_view', $data);
         $this->load->view('edit_product_view', $data);
         $this->load->view('include/footer_view');
    }

    public function processEditProduct($id)
    {
         //load helpers
         $this->load->helper(array('form', 'url'));
         //includes the form validation library.
        $this->load->library('form_validation');
        $this->load->database();
        $this->form_validation->set_rules('prod_name', 'Product Name', 'required');
        $this->form_validation->set_rules('prod_description', 'Product Description', 'required');
        $this->form_validation->set_rules('prod_price', 'Product Price', 'required|numeric');

        //run form validation
        if ($this->form_validation->run() == FALSE){
            $this->editProduct($id);
        }else {

            $data = array(
                'prod_name' => $this->input->post('prod_name'),
                'prod_description' => $this->input->post('prod_description'),
                'prod_price' => $this->input->post('prod_price')
            );

            //loads the product model
            $this->load->model('Products_model');
            $this->Products_model->editProduct($id, $data);
            redirect('home/view_products');
        }
    }

    public function viewProduct($id)
    {
        $this->load->helper(array('form', 'url'));
        //load the product model
        $this->load->model('Products_model');
        //fetch the product using the id provided in the parameter
        $data['product'] = $this->Products_model->getProduct($id);
         $data['title'] = "Edit Product";
        
         //for checking if the view is edit or view item
         $data['edit'] = false;
         $this->load->view('include/header_view', $data);
         $this->load->view('edit_product_view', $data);
         $this->load->view('include/footer_view');
    }

    public function processDelete($id)
    {
        $this->load->helper('url');
        $this->load->model('Products_model');
        $this->Products_model->deleteProduct($id);
        redirect('home/view_products');
    }
}