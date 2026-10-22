<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('education/Course_model', 'course');
    }

    /*
     *************************************************************************************************
     * Fn for listing all Courses
     * 
     * 
     * @author Althaf
     * @Updated on 12-10-2019
     * 
     * 
     ******************************************************************************************************
     */

    public function listall()
    {
		$settings = $this->course->getCompanySettings(); 
        $data['settings'] = $settings;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('education/listall',$data);
    }

    /*
     *************************************************************************************************
     * Fn for listing Discounts
     * 
     * 
     * @author Althaf
     * @created on 12-10-2019
     * 
     * 
     ******************************************************************************************************
     */

    public function listDiscount()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('education/listdiscount');
    }

    /*
     ************************************************************************************************
     * addDiscount: Adding discount values to table Discount 
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     * 
     ***************************************************************************************************
     */
    public function addDiscount($id = 0, $view = '')
    {
        $this->load->view('_blocks/subpages/create');
        $data['isbatch'] = $this->getKey('isbatch');
        $data['isgodown'] = $this->getKey('is_godown');
        $settings = $this->course->getCompanySettings(); 
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['option'] = $view;
        $data['view'] = "create";
        $this->load->view('education/adddiscount', $data);
    }

    /**
     * ****************************************************************************************************
     * savediscount: pass the discount name and percentage into the course_model
     * 
     * @author Althaf
     * @created on: 12-10-2019
     * 
     * *****************************************************************************************************
     */

    public function savediscount()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'percent' => $this->input->post('percent'),
        );

        $this->course->savediscount($data);
    }

    /*
    *****************************************************************************************************
     * getdiscount:  call the Course_model with argument  $id
     * 
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     ****************************************************************************************************
     */

    public function getdiscount($id)
    {
        return $this->course->getdiscount($id);
    }

    /*
    *****************************************************************************************************
     * delete:  call the Course_model delete fn with argument  $id
     * 
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     ****************************************************************************************************
     */

    public function delete($id)
    {
        $this->course->delete($id);
    }

    /*
    *****************************************************************************************************
     * deleteuniversity:  call the Course_model deleteuniversity fn with argument  $id
     * 
     * 
     * @author Althaf
     * @created on : 15-10-2019
     * 
     ****************************************************************************************************
     */

    public function deleteuniversity($id)
    {
        $this->course->deleteuniversity($id);
    }

    /*
    *****************************************************************************************************
     * deletecourse:  call the Course_model deletecourse fn with argument  $id
     * 
     * 
     * @author Althaf
     * @created on : 15-10-2019
     * 
     ****************************************************************************************************
     */

    public function deletecourse($id)
    {
        $this->course->deletecourse($id);
    }

    

    /*
    *****************************************************************************************************
     * getAllMode:  call the Course_model getAllMode fn 
     * 
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     ****************************************************************************************************
     */

     public function getAllMode()
     {
        return $this->course->getAllMode();
     }

     /*
    *****************************************************************************************************
     * create:  function which shows the create course view
     * 
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     ****************************************************************************************************
     */

    public function create($id = 0)
    {
        $this->load->view('_blocks/subpages/create');
        $data['isbatch'] = $this->getKey('isbatch');
        $data['isgodown'] = $this->getKey('is_godown');
        $settings = $this->course->getCompanySettings(); 
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = "create";
        $this->load->view('education/create', $data);
    }


    public function edit($id = 0)
    {
        // print_r($id);
        // exit();
        $this->load->view('_blocks/subpages/create');
        $data['isbatch'] = $this->getKey('isbatch');
        $data['isgodown'] = $this->getKey('is_godown');
        $settings = $this->course->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = "edit";
        $this->load->view('education/create', $data);
    }
    public function view($id = 0)
    {
        $this->load->view('_blocks/subpages/create');
        $data['isbatch'] = $this->getKey('isbatch');
        $data['isgodown'] = $this->getKey('is_godown');
        $settings = $this->course->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = "view";
        $this->load->view('education/create', $data);
    }

    public function addUniversity($id = 0)
    {
        // print_r($id);
        // exit();
        $data = array(
            'name' => $this->input->post('uniname'),
            'code' => $this->input->post('unid'),
        );

        $this->course->addUniversity($data, $id);
    }

    public function getUniversity()
    {
        return $this->course->getUniversity();
    }

    public function getOneUniversity($id)
    {
        return $this->course->getOneUniversity($id);
    }


    public function save()
    {
        $id = $this->input->post('id');
        $insert_id = $this->course->save($id);
    }

    /*
     ******************************************************************************************************
     * Ajax list calling from listall.php on education/listall
     * 
     * 
     * @author Althaf
     * @updated on 12-10-2019
     * 
     * 
     ******************************************************************************************************
     */

     public function university()
     {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('education/listalluniversity');
     }

     /*
     ******************************************************************************************************
     * univedit for edit th universities
     * 
     * 
     * @author Althaf
     * @updated on 12-10-2019
     * 
     * 
     ******************************************************************************************************
     */

    public function univedit($id)
    {

        $this->load->view('_blocks/subpages/create');
        $data['isbatch'] = $this->getKey('isbatch');
        $data['isgodown'] = $this->getKey('is_godown');
        $settings = $this->course->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['option'] = 'edit';
        $data['view'] = "edit";
        $this->load->view('education/createuniv', $data);
    }

    public function univcreate()
    {

        $this->load->view('_blocks/subpages/create');
        $data['isbatch'] = $this->getKey('isbatch');
        $data['isgodown'] = $this->getKey('is_godown');
        $settings = $this->course->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = 0;
        $data['option'] = 'create';
        $data['view'] = "create";
        $this->load->view('education/createuniv', $data);
    }



    /*
     ******************************************************************************************************
     * univview for viewing the universities
     * 
     * 
     * @author Althaf
     * @updated on 12-10-2019
     * 
     * 
     ******************************************************************************************************
     */

    public function uniview($id)
    {

        $this->load->view('_blocks/subpages/create');
        $data['isbatch'] = $this->getKey('isbatch');
        $data['isgodown'] = $this->getKey('is_godown');
        $settings = $this->course->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['option'] = 'view';
        $data['view'] = "edit";
        $this->load->view('education/createuniv', $data);
    }

    /*
     ******************************************************************************************************
     * Ajax list calling from listall.php on education/listall
     * 
     * 
     * @author Althaf
     * @updated on 12-10-2019
     * 
     * 
     ******************************************************************************************************
     */


    public function ajax_list()
    {
		$settings = $this->course->getCompanySettings(); 
        $list = $this->course->get_datatables();
//        print_r($list);
        //$itemcount = $this->item->getledgeritem();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();

            $row[] = $no;
			if((float) $settings[0]['is_calendar'] < 1 ){
				$row[] = $item->barcode;
			}
            $row[] = $item->name;
			if((float) $settings[0]['is_calendar'] < 1 ){
				$row[] = $item->uniname;
			}
            $row[] = $item->open_stock;
            $row[] = $item->description;
            $act = '<a id = "edittor"  href="' . base_url() . 'education/Course/edit/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                    
                    <a  class="btn btn-info "  href="' . base_url() . 'education/Course/view/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
                $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'education/Course/listall/' . '"  success="Delete ' . $item->name . ' successfuly "  message="Do you want Delete ' . $item->name . '?"  href="' . base_url() . 'education/course/deletecourse/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->course->count_all(),
            "recordsFiltered" => $this->course->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    /*
     *********************************************************************************************************
     * discount list function calling from education/listdiscount
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     * 
     **********************************************************************************************************
     */

    public function discount_list()
    {
        $this->course->where_discount();
        $list = $this->course->get_datatables();

        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->name;
            $row[] = $item->percent;
            
            $act = '<a id = "edittor"  href="' . base_url() . 'education/Course/addDiscount/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                    <a  class="btn btn-info "  href="' . base_url() . 'education/Course/addDiscount/' . $item->id . '/view" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'education/Course/listdiscount/' . '"  success="Delete ' . $item->name . ' successfuly "  message="Do you want Delete ' . $item->name . '?"  href="' . base_url() . 'education/Course/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->course->count_all(),
            "recordsFiltered" => $this->course->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    /*
     *********************************************************************************************************
     * discount list function calling from education/listdiscount
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     * 
     **********************************************************************************************************
     */

    public function university_list()
    {
        $this->course->university();
        $list = $this->course->get_datatables();

        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->name;
            $row[] = $item->code;
            
            $act = '<a id = "edittor"  href="' . base_url() . 'education/Course/univedit/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                    <a  class="btn btn-info "  href="' . base_url() . 'education/Course/uniview/' . $item->id . '/view" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'education/Course/university"  success="Delete ' . $item->name . ' successfuly "  message="Do you want Delete ' . $item->name . '?"  href="' . base_url() . 'education/Course/deleteuniversity/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->course->count_all(),
            "recordsFiltered" => $this->course->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    
}