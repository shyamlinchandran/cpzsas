<?php
class Query_execution extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('query_execution/Query_execution_model','execute');
    }
    public function list()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['titles'] = 'Query Execution';
        $this->load->view('query_execution/list',$data);
    }
    public function ajax_list()
    {
         $this->execute->list_db();
         $list = $this->execute->get_datatables();
        $data = array();
        $no = 0;
        foreach($list as $item)
        {
            $row =array();
            $no++;
            $row[] = '&nbsp <input type="checkbox" name="check_item[]" value="'.$item->new_id.'" class="chk_sub">';
           // $row[] = "";
            $row[] = $no;
            $row[] = $item->name;
            $row[] = $item->comkey;
            $row[] = $item->sdb_name;
            // $row[] = "";
            $act = '<a  href="' . base_url() . 'query_execution/Query_execution/execute_query' . $item->new_id . '/" title="Execute" data-toggle="tooltip" class="btn btn-success">Execute</a>';  
            $row[] = $act;
            $data[] = $row;
        }
        $response = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->execute->count_all(),
            "recordsFiltered" => $this->execute->count_filtered(),
            "data" => $data,
        );
        echo json_encode($response);
        
    }
    public function execute_query()
    {
        $this->execute->execute_query();  
    }
}