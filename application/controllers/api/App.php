<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class App extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $_POST = json_decode($this->input->raw_input_stream, true);
        $_GET = json_decode($this->input->raw_input_stream, true);
    }
    
    public function login_post()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $checkuser = $this->db->get_where('users', array('email' => $username))->row_array();
        
        if(!empty($checkuser)) {
            if($password == $checkuser['password']) {
                $status = array('status' => 1, 'message' => 'success');
                $resultdata = $checkuser;
            } else {
                $status = array('status' => 0, 'message' => 'Incorrect Password');
                $resultdata = $this->input->post();
            }
        } else {
            $status = array('status' => 0, 'message' => 'Invalid Username');
            $resultdata = $this->input->post();
        }
        
        $this->response(['status' => $status, 'details' => $resultdata], REST_Controller::HTTP_OK);
    }
    
    public function dashboard_post()
    {
        $this->load->model('model_products');
        $this->load->model('model_orders');
        
        $res['total_products'] = $this->model_products->countTotalProducts();
		$res['total_paid_orders'] = $this->model_orders->countTotalPaidOrders();
	    
        $status = array('status' => 1, 'message' => 'success');
        $this->response(['status' => $status, 'details' => $res], REST_Controller::HTTP_OK);
            
    }
    
    public function profile_view_post()
    {
        $user_id = $this->input->post('user_id');
        
        $user_details = $this->db->get_where('users', array('id' => $user_id))->result_array();
        
        if(!empty($user_details)) {
            $status = array('status' => 1, 'message' => 'success');
        } else {
            $status = array('status' => 0, 'message' => 'No data found');
        }
     
        $this->response(['status' => $status, 'details' => $user_details], REST_Controller::HTTP_OK);
    }
    
    public function change_password_post()
    {
        $user_id = $this->input->post('user_id');
        $res['user_id'] = $user_id;
        $current_password = $this->input->post('current_password');
        $data['password'] = $this->input->post('new_password');
        
        $user_details = $this->db->get_where('users', array('id' => $user_id))->row_array();
        
        if(!empty($user_details)) {
            if($user_details['password'] == $current_password) {
                
                $this->db->where('id', $user_id);
                $this->db->update('users', $data);
                
                $status = array('status' => 1, 'message' => 'success');
            } else {
                $status = array('status' => 0, 'message' => 'Current password is incorrect');
            }
            
        } else {
            $status = array('status' => 0, 'message' => 'No data found');
        }
     
        $this->response(['status' => $status, 'details' => $res], REST_Controller::HTTP_OK);
    }
    
    
    public function category_list_post()
    {
        $categories = $this->db->get_where('category', array('active' => 1))->result_array();
        
        if(!empty($categories)) {
            $status = array('status' => 1, 'message' => 'success');
        } else {
            $status = array('status' => 0, 'message' => 'No data found');
        }
     
        $this->response(['status' => $status, 'details' => $categories], REST_Controller::HTTP_OK);
     
    }
    
    public function add_category_post()
    {
        $data['name'] = $this->input->post('category_name');
        $data['active'] = 1;
        
        $cat_exists = $this->db->get_where('category', array('name' => $data['name']))->row_array();
        
        if(empty($cat_exists)) {
            if($this->db->insert('category', $data)) {
                $status = array('status' => 1, 'message' => 'success');
            } else {
                $status = array('status' => 0, 'message' => 'Failed to Add Category');
            }
        } else {
            $status = array('status' => 0, 'message' => 'Category name already exists');
        }
        
        $this->response(['status' => $status, 'details' => $data], REST_Controller::HTTP_OK);
     
    }
    
    
    public function item_list_post()
    {
        $items = $this->db->get_where('products', array('active' => 1))->result_array();
        
        if(!empty($items)) {
            $status = array('status' => 1, 'message' => 'success');
        } else {
            $status = array('status' => 0, 'message' => 'No data found');
        }
     
        $this->response(['status' => $status, 'details' => $items], REST_Controller::HTTP_OK);
    }
    
    public function add_item_post()
    {
        $upload_image = $this->upload_image();

    	$data = array(
    		'name' => $this->input->post('product_name'),
    		'price' => $this->input->post('price'),
    		'image' => $upload_image,
    		'description' => $this->input->post('description'),
    		'category_id' => json_encode($this->input->post('category')),
            'store_id' => json_encode($this->input->post('store')),
    		'active' => 1,
    	);
    
        $this->load->model('model_products');
    
    	$create = $this->model_products->create($data);
    	if($create == true) {
    		$status = array('status' => 1, 'message' => 'success');
    	}
    	else {
    		$status = array('status' => 1, 'message' => 'Faled to add item');
    	}
    	
    	$this->response(['status' => $status, 'details' => $data], REST_Controller::HTTP_OK);
 
    }
    
    public function upload_image()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/product_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('product_image'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['product_image']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

    public function view_item_post()
    {
        $item_id = $this->input->post('item_id');
        
        $item = $this->db->get_where('products', array('id' => $item_id))->row_array();
        
        if(!empty($item)) {
            $status = array('status' => 1, 'message' => 'success');
        } else {
            $status = array('status' => 0, 'message' => 'No data found');
        }
     
        $this->response(['status' => $status, 'details' => $item], REST_Controller::HTTP_OK);
    }
    
    public function get_gst_percentage_post()
    {
        $comp = $this->db->get_where('company', array('id' => 1))->row_array();
        
        if(!empty($comp)) {
            $status = array('status' => 1, 'message' => 'success');
            $res['gst_percentage'] = $comp['vat_charge_value'];
        } else {
            $status = array('status' => 0, 'message' => 'No data found');
            $res['gst_percentage'] = 0;
        }
        
        $this->response(['status' => $status, 'details' => $res], REST_Controller::HTTP_OK);
    }
    
    public function create_order_post()
    {
        $this->load->model('model_orders');
        
        $order_id = $this->model_orders->create_api();
        
        if($order_id) {
            $status = array('status' => 1, 'message' => 'success');
        } else {
            $status = array('status' => 0, 'message' => 'Failed to create order');
        }
        
        $res['order_id'] = $order_id;
        
        $this->response(['status' => $status, 'details' => $res], REST_Controller::HTTP_OK);
    }
    
    public function order_list_post()
    {
        $orders = $this->db->get_where('orders')->result_array();
        
        if(!empty($orders)) {
            $status = array('status' => 1, 'message' => 'success');
        } else {
            $status = array('status' => 0, 'message' => 'No data found');
        }
     
        $this->response(['status' => $status, 'details' => $orders], REST_Controller::HTTP_OK);
    }
    
    public function view_order_post()
    {
        $order_id = $this->input->post('order_id');
        
        $res['order'] = $this->db->get_where('orders', array('id' => $order_id))->row_array();
        
        if(!empty($res['order'])) {
            
            $this->db->select('t1.*, t2.name AS product_name');
            $this->db->from('order_items t1');
            $this->db->join('products t2', 't2.id=t1.product_id');
            $this->db->where('t1.order_id', $order_id);
            $query = $this->db->get();
            $order_items = $query->result_array();
            
            $res['order_items'] = $order_items;
            
            $status = array('status' => 1, 'message' => 'success');
        } else {
            $status = array('status' => 0, 'message' => 'No data found');
        }
     
        $this->response(['status' => $status, 'details' => $res], REST_Controller::HTTP_OK);
    }

    public function update_paid_status_post()
    {
        $order_id = $this->input->post('order_id');
        $order_data['paid_status'] = $this->input->post('paid_status');
        
        $res['order_id'] = $order_id;
        
        $this->db->where('id', $order_id);
        $this->db->update('orders', $order_data);
        
        $status = array('status' => 1, 'message' => 'success');
        
        $this->response(['status' => $status, 'details' => $res], REST_Controller::HTTP_OK);
    }

    public function update_invoice_status_post()
    {
        $order_id = $this->input->post('order_id');
        $order_data['invoice_status'] = $this->input->post('invoice_status');
        
        $res['order_id'] = $order_id;
        
        $this->db->where('id', $order_id);
        $this->db->update('orders', $order_data);
        
        $status = array('status' => 1, 'message' => 'success');
        
        $this->response(['status' => $status, 'details' => $res], REST_Controller::HTTP_OK);
    }


    public function delete_order_post() 
    {
        $order_id = $this->input->post('order_id');
        
        $order_row = $this->db->get_where('orders', array('id' => $order_id))->row_array();
        
        $res['order_id'] = $order_id;
        
        if(!empty($order_row)) {
            
            $this->db->where('id', $order_id);
            $this->db->delete('orders');
            
            $status = array('status' => 1, 'message' => 'success');
        } else {
            $status = array('status' => 0, 'message' => 'no row found');
        }
        
        $this->response(['status' => $status, 'details' => $res], REST_Controller::HTTP_OK);
    }

    public function monthly_reports_post()
    {
        $year = $this->input->post('year');
        
        $monthres = array();
        
        $monthres['year'] = $year;
        
        $m = 0;
        
        for($m=1; $m<=12; $m++) {
            
            $month_name = date("F", mktime(0, 0, 0, $m, 10));
            
            $this->db->select('SUM(net_amount) as total_paid');
            $this->db->from('orders');
            $this->db->where('paid_status', 1);
            $this->db->where('month(created_date)', $m);
            $this->db->where('year(created_date)', $year);
            $query = $this->db->get();
            $thismonres = $query->row_array();
            $monres = $thismonres['total_paid'];
            
            if(!empty($monres)) {
                $monthres['months'][][$month_name] = $monres;
            } else {
                $monthres['months'][][$month_name] = 0;
            }
        }
        
        if(!empty($monthres)) {
            $status = array('status' => 1, 'message' => 'success');
        } else {
            $status = array('status' => 0, 'message' => 'No data found');
        }
        
        $this->response(['status' => $status, 'details' => $monthres], REST_Controller::HTTP_OK);
    }
    
    
    

}

?>