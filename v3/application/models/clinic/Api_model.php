<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Api_model
 *
 * @author jijodileep
 */
class Api_model extends DataTable {

    //put your code here
    function getallbooking() {
        $tmp = $this->session->userdata('user');
        $branch = $tmp['branch'];
        $qry = "SELECT bok_id as id, b.Pat_Name as title ,ADDTIME(a.bok_date,c.Schedule_Time) start,ADDTIME(a.bok_date,ADDTIME(c.Schedule_Time,  d.Intervell  )) end,c.Schedule_Time,d.Intervell,Bok_Approved as type,
                    (CASE Bok_Approved WHEN 'Approve'      THEN  '#00a65a'
                       WHEN 'Pending' THEN '#00c0ef'
                       ELSE  '#f012be'
       END )AS  backgroundColor FROM cli_booking as a INNER JOIN cli_patient as b on b.Pat_Id =a.Cus_Id INNER JOIN cli_timeschedule as c on a.Shedule_id =c.TimeSch_Id inner JOIN cli_time_intervell as d on a.Intervell_id=d.Ti_id  where Bok_Approved in ('Approve','Reject','Checked') and a.Cat_Id =" . $branch; //'Pending'
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

}
