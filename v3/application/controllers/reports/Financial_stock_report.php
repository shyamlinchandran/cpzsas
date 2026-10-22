<?php 
class Financial_stock_report extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reports/Financial_stock_model','stock');
    }
    public function list()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['titles'] = 'Stock Taking Tool';
        $this->load->view('reports/financial_stock_report/list',$data);
    }
    public function create($id=0,$type="create")
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['id'] = $id;
        $data['view'] = $type;
        $this->load->view('reports/financial_stock_report/create',$data); 
    }
    public function ajax_list()
    {
        // $this->stock->where();
        $list = $this->stock->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->invoice;
            $row[] = $item->created_date;
            $act = '<a  href="' . base_url() . 'reports/Financial_stock_report/create/' . $item->id . '/edit" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>                  
                    <a  class="btn btn-info "  href="' . base_url() . 'reports/Financial_stock_report/create/' . $item->id . '/view" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
                $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'reports/Financial_stock_report/list/' . '"  success="Delete ' . $item->created_by . ' successfuly "  message="Do you want Delete ' . $item->created_by . '?"  href="' . base_url() . 'reports/Financial_stock_report/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->stock->count_all(),
            "recordsFiltered" => $this->stock->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function ajax_list_create()
    {
        $this->stock->get_data();
        $list = $this->stock->get_datatables();
        $data = array();
        $no = 0;
        foreach($list as $item) 
        {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->code;
            $row[] = $item->name;
            $row[] = $item->hsn;
            $row[] = $item->vendor;
            $row[] = $item->prate;
            $row[] = $item->srate;
            $row[] = $item->sgst;
            $row[] = $item->cgst;
            $row[] = $item->igst;
            $row[] = $item->gst;
            $row[] = $item->quantity;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->stock->count_all(),
            "recordsFiltered" => $this->stock->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function save()
    {
        $this->stock->save();
    }
    public function delete($id)
    {
        $this->stock->delete($id);
    }
    public function getsing($id)
    {
        $this->stock->getsing($id);
    }
    public function auto_item($type='')
    {
        $search = strtolower($_GET['term']);
        return  $this->stock->auto_item($search,$type);
    }
    public function auto_barcode($type='')
    {
        $search = $this->input->post('item_code');
        return  $this->stock->auto_barcode($search,$type); 
    }
}