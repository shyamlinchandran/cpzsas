<?php

class Service_implementation_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();
        $this->select = " s.imp_id,s.name,s.motor,s.installation_date,s.installation_team,s.warranty_till_date";
        $this->table = 'service_implementation as s';
        $this->column_order = array(null, 's.name', null); //set column field database for datatable orderable   
        $this->column_search = array('s.name'); //set column field database for datatable searchable 
        $this->order = array('s.imp_id' => 'desc'); // default order 
    }
	
	function implementation_type(){
		$qry ="select * from implementation_type";
		$result = $this->db->query($qry)->result_array();
		$option = '<option value="">Select</option>';
		foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
	}
	
	function insert_customerdetails($data){
		$this->db->insert('suppliers',$data);
		$id = $this->db->insert_id();
		$ledger_data = array(
                        "name" => $data['name'],
                        "code" => $data['phone'],
                        "ref_id" => $id,
                        "ref_code" => 'cus',
                        "is_default" => true,
                        "acc_main_id" => 25,
                        "openning_bal" => 0,
                        "type" => 'Dr',
                        "published" => 'yes'
                    );
        $this->db->insert('acc_ledgers', $ledger_data);
		return $id;
	}
	
    public function save()
    {
        $id = $this->input->post('id');
        $unique_id = $this->input->post('unique_id');
        $primary_id = $this->input->post('primary_id');
        $edit_db = $this->input->post('edit_db');
        $name_id = $this->input->post('name_id');
		$qry = "select * from suppliers where lead_ref_id = ".$name_id;
		$query = $this->db->query($qry);
		$phone ='';
		if($this->input->post('cus_phone')){
			$phone = $this->input->post('cus_phone');
		}
		$name = $this->input->post('name');
		$email = '';
		if($this->input->post('cus_email')){
			$email = $this->input->post('cus_email');
		}
		$address ='';
		if($this->input->post('cus_address')){
			$address = $this->input->post('cus_address');
		}
		$location= '';
		if($this->input->post('cus_location')){
			$location = $this->input->post('cus_location');
		}
		if($query->num_rows() < 1 ){
			$customer_details = array(
					'name'=>$name,
					'phone'=>$phone,
					'lead_ref_id'=>$name_id,
					'address_line1'=>$address,
					'type'=>'cus'
			);
			$this->insert_customerdetails($customer_details);
		}
        $name = $this->input->post('name');
        $motor = $this->input->post('motor');
        $contract = $this->input->post('contract');
        $remote = $this->input->post('remote');
        //   $installation_date = $this->getdate($this->input->post('install_date'));
        $installation_date = $this->input->post('install_date');
        $installation_team = $this->input->post('install_team');
        // $warranty_till_date = $this->getdate($this->input->post('warranty_date'));
        $warranty_till_date = $this->input->post('warranty_date');
        $transport_by = $this->input->post('transport_by');
        $transport_charge = $this->input->post('transport_charge');
        $despach_by = $this->input->post('despach_by');
        $extra_accessories = $this->input->post('extra_access');

        $product_id = $this->input->post('product_id', true);
        $measurement = $this->input->post('measurement',true);
        $quantity = $this->input->post('quantity',true);
		$imp_type_id = $this->input->post('sub_name',true);

        $document_type = $this->input->post('file_select', true);
        $file_select_id = $this->input->post('file_select_id', true);

        $file = $this->input->post('image_file');


        $data = array(
            'name' => $name,
			'lead_id'=>$name_id,
			'phone'=>$phone,
			'email'=>$email,
			'address'=>$address,
			'Location'=>$location,
            'motor' => $motor,
            'contract' => $contract,
            'remote' => $remote,
            'installation_date' => $installation_date,
            'installation_team' => $installation_team,
            'warranty_till_date' => $warranty_till_date,
            'transport_by' => $transport_by,
            'transport_charge' => $transport_charge,
            'despach_by' => $despach_by,
            'extra_accessories' => $extra_accessories
        );

        if ($id == 0) {
            $this->db->insert('service_implementation', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $insert_id = $id;
            $this->db->where('imp_id', $id);
            $this->db->update('service_implementation', $data);

            $qry = "delete from service_implementation_items where imp_id =" . $id;
            $this->db->Query($qry);

            $qry = "delete from service_implementation_documents where service_imp =" . $id;
            $this->db->query($qry);
        }

        if ($this->input->post('product_id', true)) {

            $length = sizeof($product_id);
            for ($i = 0; $i < $length; $i++) {
                $data_items = array(

                    'imp_id' => $insert_id,
                    'product_id' => $product_id[$i],
                    'measurement' => $measurement[$i],
                    'quantity' => $quantity[$i],
					'imp_type_id'=>$imp_type_id[$i]

                );
                if ($id == $id) {
                    $this->db->insert('service_implementation_items', $data_items);
                }
            }
        }

        if ($this->input->post('file_select_id', true)) {
            $len = sizeof($file_select_id);
            for ($i = 0; $i < $len; $i++) {
                
                $file_upload = array(
                    'service_imp' => $insert_id,
                    'document_type' => $document_type[$i],                   
                    'file' => basename($file[$i]),
                );
                if ($id == $id) {
                    $this->db->insert('service_implementation_documents', $file_upload);
                }
            }
        }

        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }
    function getsing($id)
    {
        //    $qry = 'select a.*,b.*,i.name as product_name from service_implementation as a left join service_implementation_items 
        //    as b on a.imp_id=b.imp_id left join item as i on i.id=b.product_id where b.imp_id=' . $id;
        $qry = 'SELECT * FROM service_implementation where imp_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
    public function delete_db($unique_id)
    {
        $qry = "delete from service_implementation_items where id=" . $unique_id;
        $this->db->query($qry);
    }
    public function other_item($id)
    {
        $qry = "SELECT it.id as imptypeid,it.name as imptypename,i.name as product_name,si.id as unique_id,si.* FROM service_implementation_items as si left join implementation_type as it on it.id=imp_type_id INNER join item as i on i.id=si.product_id where imp_id =" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    public function image_docs($id)
    {
        $qry = "SELECT s.id as primary_id,s.service_imp,s.document_type as file_select,s.file as image_file FROM service_implementation_documents as s where service_imp=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function delete($id)
    {
        $qry = "Delete from service_implementation where imp_id=" . $id;
        $this->db->query($qry);
    }
    public function get_name($search)
    {
        $qry = "SELECT l.*,l.companyName as label FROM lead_register as l where l.companyName like '%" . $search . "%' ";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    public function product_name($test)
    {
        $qry = "SELECT i.*,i.name as label  FROM item as i WHERE i.name LIKE '%" . $test . "%' ";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
}
