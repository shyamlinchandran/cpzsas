<?php

class Bom_controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('production/bom/bom_model', 'bom');
    }

    public function create($id = 0)
    {
        $settings = $this->bom->getCompanySettings();

        $is_export_invoice = 0;
        if (isset($settings[0]['is_export_invoice'])) {
            $is_export_invoice = $settings[0]['is_export_invoice'];
        }
        $data['title'] = 'Bill Of Materials';
        $data['id'] = $id;
        $data['view'] = "create";
        $data['is_export_invoice'] = $is_export_invoice;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/bom/create', $data);
    }
    public function delete($id)
    {
        $this->bom->delete($id);
    }
    public function edit($id)
    {
        $settings = $this->bom->getCompanySettings();

        $is_export_invoice = 0;
        if (isset($settings[0]['is_export_invoice'])) {
            $is_export_invoice = $settings[0]['is_export_invoice'];
        }
        $data['title'] = 'Bill Of Materials';
        $data['id'] = $id;
        $data['view'] = "edit";
        $data['is_export_invoice'] = $is_export_invoice;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/bom/create', $data);
    }
    public function view($id)
    {
        $settings = $this->bom->getCompanySettings();

        $is_export_invoice = 0;
        if (isset($settings[0]['is_export_invoice'])) {
            $is_export_invoice = $settings[0]['is_export_invoice'];
        }
        $data['title'] = 'Bill Of Materials';
        $data['id'] = $id;
        $data['view'] = "view";
        $data['is_export_invoice'] = $is_export_invoice;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/bom/create', $data);
    }
    public function listall()
    {

        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/bom/listall');
    }
    public function ajaxListAll()
    {   
        $this->bom->where();
        $list = $this->bom->get_datatables();
        $no = $this->input->post('start');
        $data = array();
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[]  = $no;
            $row[] = $item->name;
            $row[] = $item->quantity;
            $row[] = $item->price_per_quantity;
            $row[] = $item->grandtotal;
            $act = '<a base="' . base_url() . 'production/bom/bom_controller/listall/' . '" href="' . base_url() . 'production/bom/bom_controller/edit/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
            <a  class="btn btn-info " base="' . base_url() . 'production/bom/bom_controller/listall/' . '" href="' . base_url() . 'production/bom/bom_controller/view/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'production/bom/bom_controller/listall/' . $item->id . '"  success="Delete ' . $item->name . ' successfuly "  message="Do you want Delete ' . $item->name . '?"  href="' . base_url() . 'production/bom/bom_controller/delete/' . $item->id . ' " data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->bom->count_all(),
            "recordsFiltered" => $this->bom->count_filtered(),
            "data" => $data
        );

        echo json_encode($output);
    }
    public function getData($id)
    {

        $product = $this->bom->getData($id);
        $result = $this->bom->getMaterialData($id);
        $ledger = $this->bom->getLedgerData($id);
        $return = [
            'product' => $product,
            'result' => $result,
            'ledger' => $ledger
        ];
        echo  json_encode($return);
    }

    public function product_search()
    {

        $search = strtolower($_GET['term']);
        return $this->bom->product_search($search);
    }
    public function search_material()
    {

        $search = strtolower($_GET['term']);
        return $this->bom->search_material($search);
    }

    public function search_ledger()
    {

        $search = strtolower($_GET['term']);
        return $this->bom->search_ledger($search);
    }


    public function save()
    {

        $this->bom->save();
    }
}
