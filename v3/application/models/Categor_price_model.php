<?php


class Categor_price_model extends DataTable
{


    public function __construct()
    {
        parent::__construct();
        $this->select = 'a.name,b.*';
        //,c.name as group_name,d.name as unit,e.name as tax 
        $this->table = 'item_category as a inner join  `category_rate` as b on a.id = b.`category_id` ';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null,'name', 'date','gold_rate','old_gold_rate'); //set column field database for datatable orderable   
        $this->column_search = array('name', 'date','gold_rate','old_gold_rate'); //set column field database for datatable searchable 
        $this->order = array('b.date' => 'desc'); // default order 
        $this->wherecondition= ' where b.published = "yes" ';
    }

    public function getsing($id){
        $qry = "select a.*,DATE_FORMAT(date,'%d/%m/%Y') as dates from category_rate as a  where id = ".$id;
        $data = $this->db->query($qry)->row_array();
        echo json_encode($data);
    }

    public function save(){
        $modal_gold_date = $this->input->post('modal_gold_date');
        $modal_gold_category = $this->input->post('modal_gold_category');
        $modal_gold_rate = $this->input->post('modal_gold_rate');
        $modal_gold_id = $this->input->post('modal_gold_id');
        $modal_old_gold_rate = $this->input->post('modal_old_gold_rate');
        $date = $this->getDate($modal_gold_date);
        $data = array(
            'category_id'=>$modal_gold_category,
            'date'=>$date,
            'gold_rate'=>$modal_gold_rate,
            'old_gold_rate'=>$modal_old_gold_rate
        );
        $qry = "select * from category_rate where date = '".$date."' and category_id = '".$modal_gold_category."' and published = 'yes' ";
        $exist = $this->db->query($qry);
        if($exist->num_rows() > 0 ){
            $exist = $exist->row_array();
            $datanil = array(
                'published'=>'no'
            );
            $this->db->where('id',$exist['id']);
            $this->db->update('category_rate',$datanil);

            $this->db->insert('category_rate',$data);
        }else{
            $this->db->insert('category_rate',$data);
        }
        return 1;
    }

	
}
?>