<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author jijodileep 
 */
class Schedule_model extends DataTable
{

    /***************************************************************************************************
     * Ajax call function 
     * 
     * @author Althaf
     * @updated at 11-10-2019
     * 
     * 
     ***************************************************************************************************/

    public function __construct()
    {
        parent::__construct();
        $this->select = 'a.*,DATE_FORMAT(schedule_start_date,"%d/%m/%Y") as start_date,DATE_FORMAT(schedule_end_date,"%d/%m/%Y") as end_date';
        //,c.name as group_name,d.name as unit,e.name as tax 
        $this->table = 'yoga_schedule as a';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'schedule_name', 'schedule_start_date', 'schedule_end_date', 'description'); //set column field database for datatable orderable   
        $this->column_search = array( 'schedule_name', 'schedule_start_date', 'schedule_end_date', 'description'); //set column field database for datatable searchable 
        $this->order = array('schedule_name' => 'asc'); // default order 
		$this->wherecondition = ' where published = "yes" ' ;
    }


    /***************************************************************************************************
     * fee structure call function 
     * 
     * @author Althaf
     * 
     * @created on : 11-10-2019
     * @updated at : 18-10-2019
     * 
     * 
     ***************************************************************************************************/

	function save(){
	   $schedule = $this->input->post('schedule');
	   $schedule_start_date = $this->getDate($this->input->post('schedule_start_date'));
	   $schedule_end_date = $this->getDate($this->input->post('schedule_end_date'));
	   $description = $this->input->post('description');
	   $data = array(
			'schedule_name'=>$schedule,
			'schedule_start_date'=>$schedule_start_date,
			'schedule_end_date'=> $schedule_end_date ,
			'description'=>$description
	   );
	   $id = $this->input->post('id');
	   if((float) $id < 1 ){
		   $this->db->insert('yoga_schedule',$data);
		   $insert_id = $this->db->insert_id();
		}else{
			$this->db->where('schedule_id',$id);
			$this->db->update('yoga_schedule',$data);
		    $insert_id = $id;
		}
		$schedule_time = $this->input->post('schedule_time',true);
		$length = sizeof($schedule_time);
		for($i =0;$i<$length;$i++){
			$time = $schedule_time[$i];
			$class = $this->input->post('monday_'.$time);
			$this->update_schedule($insert_id,$time,$class,'1','monday');
			
			$class = $this->input->post('tuesday_'.$time);
			$this->update_schedule($insert_id,$time,$class,'2','tuesday');
			
			$class = $this->input->post('wednesday_'.$time);
			$this->update_schedule($insert_id,$time,$class,'3','wednesday');
			
			$class = $this->input->post('thursday_'.$time);
			$this->update_schedule($insert_id,$time,$class,'4','thursday');
			
			$class = $this->input->post('friday_'.$time);
			$this->update_schedule($insert_id,$time,$class,'5','friday');
			
			$class = $this->input->post('saturday_'.$time);
			$this->update_schedule($insert_id,$time,$class,'6','saturday');
			
			$class = $this->input->post('sunday_'.$time);
			$this->update_schedule($insert_id,$time,$class,'7','sunday');
		}
		
		$response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}
	
	
	function update_schedule($insert_id,$time,$class,$day,$dayname){
		$qry = "select * from yoga_schedule_items where schedule_id = ".$insert_id." and time = '".$time."' and day = '".$day."' ";
		$query = $this->db->query($qry);
		$data = array(
			'schedule_id'=>$insert_id,
			'time'=>$time,
			'day'=>$day,
			'class'=>$class,
			'dayname'=>$dayname
		);
		if($query->num_rows() > 0 ){
			$this->db->where('schedule_id',$insert_id);
			$this->db->where('time',$time);
			$this->db->where('day',$day);
			$this->db->update('yoga_schedule_items',$data);
		}else{
			$this->db->insert('yoga_schedule_items',$data);
		}
	}
	
	function getsing($id){
		$qry = "SELECT IFNULL(cls_id,0) as cls_id ,IFNULL(c.bg_color,'') as bg_color,a.*,b.dayname,b.time,b.class,DATE_FORMAT(schedule_start_date,'%d/%m/%Y') as start_date,DATE_FORMAT(schedule_end_date,'%d/%m/%Y') as end_date FROM `yoga_schedule` as a INNER JOIN yoga_schedule_items as b on a.schedule_id = b.schedule_id and a.schedule_id = ".$id ." left join yoga_classes as c on c.cls_id  = b.class" ;
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}
	function gettimes(){
		$qry = "SELECT * FROM `yoga_times` where published = 'yes'";
		$result = $this->db->query($qry)->result_array();
		return $result;
	}
	
	function getclasses(){
		$qry = "select * from yoga_classes where published = 'yes' order by cls_name asc";
		$exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option style="text-color:red;" value = "0"><span class="red_color">---------------- </span></option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["cls_id"] . '">' . $row["cls_name"] . '</option>';
        }
        return $option;
	}

}