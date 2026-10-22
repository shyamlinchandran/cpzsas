<?php

Flight::route('/customer/register(/@uuid(/@leg))', function($uuid, $leg) {
    require 'config/config.php';
    $db->where("is_delete", 0);
    $packages = $db->get("packages");
    $sess_user = $_SESSION['user'];
    $db->where("uuid", $sess_user['uuid']);
    $sessuser = $db->get("customers");
    $db->where("parent", $uuid);
    $users = $db->getOne("customers");
    $leg = $leg;
    include 'views/admin/_hedder.php';
    include 'views/customer_register.php';
    include 'views/admin/_footer.php';
});
Flight::route('/admin/customer/save_to_wallet', function() {
    require 'config/config.php';
    $sess_user = $_SESSION['user'];
    $admin_uuid = $sess_user['uuid'];
    if (isset($_REQUEST['leg'])) {
        $leg = $_REQUEST['leg'];
        $uuid = $_REQUEST['uuid'];
        $length = sizeof($leg);
        for ($i = 0; $i < $length; $i++) {
            $customer_uuid = $leg[$i];
            $amount_paid = $_REQUEST['payable_' . $customer_uuid];
            if ((float) $amount_paid > 0) {
                $amount_paid = ($amount_paid * 15) / 100;
            }
            $data = array(
                'is_paid' => 1,
                'total_paid' => $amount_paid
            );
            $db->where("paymentuseruuid", $uuid);
            $db->where("createduseruuid", $customer_uuid);
            $db->update("customer_tree", $data);
        }
        $amount = $_REQUEST['payamount'];
        $data_amount = array(
            'total_paid_amount' => $db->inc($amount)
        );
        $db->where("uuid", $uuid);
        $db->update("customers", $data_amount);
    }
    Flight::redirect('/admin/customer/list_all/' . $admin_uuid);
});
Flight::route('/actionsavesupport', function() {
    require 'config/config.php';
    $sess_user = $_SESSION['user'];
    $uuid = $sess_user['uuid'];
    $message = $_REQUEST['message'];
    $data = array(
        'message' => $message,
        'customer_uuid' => $uuid
    );
    $id = $db->insert("customer_support", $data);
    Flight::redirect('/admin/customer/support');
});

Flight::route('/actionsavereplay', function() {
    require 'config/config.php';
    $sess_user = $_SESSION['user'];
    $uuid = $sess_user['uuid'];
    $support_id = $_REQUEST['support_id'];
    $replay = $_REQUEST['replay'];
    $data = array(
        'replay' => $replay
    );
    $db->where("id", $support_id);
    $db->update("customer_support", $data);
    Flight::redirect('/admin/customer/support');
});

Flight::route('/customer/getcustomer', function() {
    require 'config/config.php';
    $sess_user = $_SESSION['user'];
    $uuid = $sess_user['uuid'];
    $text = $_GET['term'];
});


Flight::route('/listrequest', function() {
    require 'config/config.php';
    include 'views/admin/_hedder.php';
    include 'views/admin/request_list.php';
    include 'views/admin/_footer.php';
});


Flight::route('/get_request_list', function() {
    require 'config/config.php';
    $user = $_SESSION['user'];
    $type = $user['userRole'];
    $sesion_uuid = $user['uuid'];
    $start = $_REQUEST['length'];
    /* get start number from page */
    $skip = $_REQUEST['start'];
    $status = $_REQUEST['status'];
    /* get search string from page */
    $search = $_REQUEST['search'];
    /* Listing columns */
    $arraycolums = array('b.name', 'b.mobile', 'a.date', 'a.amount', 'a.status');
    /* if search string is  present added to the conditon */
    if ($search['value'] != '') {
        $db->where(implode(" like ('%" . $search['value'] . "%') or  ", $arraycolums), '%' . $search['value'] . '%', 'like');
    }
    if ($status != "") {
        $db->where('status', $status);
    }

    /* Oder By */
    $sort = $_REQUEST['order'];
    if ($sort[0]['column'] < sizeof($arraycolums)) {
        $db->orderBy($arraycolums[$sort[0]['column']], $sort[0]['dir']);
    } else {
        $db->orderBy("a.id", "desc");
    }
    /* get correct data */
    $assets = $db->withTotalCount()->get("payment_request as a inner join customers as b on a.customer_uuid=b.uuid", Array($skip, $start), 'paid_date,paid_amount,code,b.uuid,a.id,b.total_paid_amount-b.total_consumed as balance,' . implode(",", $arraycolums));
    //echo $db->getLastQuery(); 
    $total = $db->totalCount;
    /* Create JSON for datatable */
    $data = array();

    foreach ($assets as $item) {
        $row = array();
        foreach ($arraycolums as $singlecolumn) {
            $out = explode(".", $singlecolumn);
            $row[] = $item[$out[1]];
        }
//        $act  = '<a  href="' . $base_url . 'customer/register/' . $item['userId'] . '" title="Edit" data-toggle="tooltip" class="btn btn-sm btn-success "><span class="fa fa-pencil-square-o"></span></a>';
        $row[] = $item['balance'];
        $row[] = $item['paid_amount'];
        $row[] = $item['paid_date'];
        $row[] = $item['code'];
        $act = '';
        if ($item['status'] != 'success') {
            $act = $act . ' <a tp="confirm" balance="' . $item['balance'] . '" user="' . $item['uuid'] . '"   support_id="' . $item['id'] . '"  data-toggle="tooltip" title="Change Status" type="button" class="btn btn-primary pay" data-toggle="modal" data-target="#statusmodal">Pay</span></a>';
            $act = $act . ' <a tp="confirm"   support_id="' . $item['id'] . '"  data-toggle="tooltip" title="Change Status" type="button" class="btn btn-warning change_stat" data-toggle="modal" data-target="#statusmodal">Change Status</span></a>';
        } else {
            $act = $act . ' <a tp="confirm"   data-toggle="tooltip" title="" type="button" class="btn btn-warning" data-toggle="modal" data-target="#">Completed</span></a>';
        }
//        if ($item['status'] == 'created') {
//            $act = $act . '&nbsp;<a  href="' . $base_url . 'confirmpayment/' . $item['payment_id'] . '" title="Edit" data-toggle="tooltip" class="btn btn-sm btn-primary ">Confirm</a>';
//        } else if($item['status'] == 'success'){
//            $act = $act . '&nbsp;<a  href="#" title="Edit" data-toggle="tooltip" class="btn btn-sm btn-success ">'.$item['status'].'</a>';
//        }else{
//            $act = $act . '&nbsp;<a  href="#" title="Edit" data-toggle="tooltip" class="btn btn-sm btn-danger ">'.$item['status'].'</a>';
//        }
        $row[] = $act;
        $data[] = $row;
    }
    $output = array(
        "draw" => $_REQUEST['draw'],
        "recordsTotal" => $total,
        "recordsFiltered" => $total,
        "data" => $data,
    );

    echo json_encode($output);
});

Flight::route('/actionchangestatus', function() {
    require 'config/config.php';
    $sess_user = $_SESSION['user'];
    $uuid = $sess_user['uuid'];
    $support_id = $_REQUEST['status_support_id'];
    $change_stat = $_REQUEST['change_stat'];
    $data = array(
        'status' => $change_stat
    );
    $db->where("id", $support_id);
    $db->update("customer_support", $data);
    Flight::redirect('/admin/customer/support');
});

Flight::route('/customerpayment', function() {
    require 'config/config.php';
    $sess_user = $_SESSION['user'];
    $pay_user_id = $_REQUEST['pay_user_id'];
    $pay_support_id = $_REQUEST['pay_support_id'];
    $amount = $_REQUEST['amount'];
    $code = $_REQUEST['code'];

    $data = array(
        'paid_date' => date('Y-m-d'),
        'paid_amount' => $amount,
        'code' => $code,
        'status' => 'success'
    );
    $db->where("id", $pay_support_id);
    $db->update("payment_request", $data);
    $data = array(
        'total_consumed' => $db->inc($amount)
    );
    $db->where("uuid", $pay_user_id);
    $db->update("customers", $data);
    Flight::redirect('/listrequest');
});

Flight::route('/changestatus', function() {
    require 'config/config.php';
    $sess_user = $_SESSION['user'];
    $uuid = $sess_user['uuid'];
    $support_id = $_REQUEST['status_support_id'];
    $change_stat = $_REQUEST['change_stat'];
    $data = array(
        'status' => $change_stat
    );
    $db->where("id", $support_id);
    $db->update("payment_request", $data);
    Flight::redirect('/listrequest');
});

Flight::route('/paymentrequest', function() {
    require 'config/config.php';
    $sess_user = $_SESSION['user'];
    $uuid = $sess_user['uuid'];
    $amount = $_REQUEST['amount'];
    $data = array(
        'customer_uuid' => $uuid,
        'amount' => $amount,
        'date' => date('Y-m-d')
    );
    $db->insert("payment_request", $data);
    Flight::redirect('/admin/customer/list_bonus');
});

Flight::route('/admin/customer/getcustomerbonuslist', function() {
    require 'config/config.php';
    $user = $_SESSION['user'];
    $start = $_REQUEST['length'];
    /* get start number from page */
    $skip = $_REQUEST['start'];
    $type = $user['userRole'];
    $uuid = $user['uuid'];
    $db->where("paymentuseruuid", $uuid);
    if (isset($_REQUEST['status'])) {
        if ($_REQUEST['status'] != '') {
            $db->where("is_paid", $_REQUEST['status']);
        }
    }
    $db->where("paymentuserLeg", 'Left');
    $wallet_details_left = $db->withTotalCount()->get(" `customer_tree` as a INNER JOIN customers as b on a.createduseruuid=b.uuid", Array($skip, $start), "b.name,a.amount,a.percentage,b.uuid,a.paymentuseruuid,paymentuserLeg,ROUND((a.amount*a.percentage)/100,2) as payable,is_paid");
    $length = $db->totalCount;
    $db->where("paymentuseruuid", $uuid);
    if (isset($_REQUEST['status'])) {
        if ($_REQUEST['status'] != '') {
            $db->where("is_paid", $_REQUEST['status']);
        }
    }
    $db->where("paymentuserLeg", 'Right');
    $wallet_details_right = $db->withTotalCount()->get(" `customer_tree` as a INNER JOIN customers as b on a.createduseruuid=b.uuid", Array($skip, $start), "b.name,a.amount,a.percentage,b.uuid,a.paymentuseruuid,paymentuserLeg,ROUND((a.amount*a.percentage)/100,2) as payable,is_paid");
    if ($db->totalCount > $length) {
        $length = $db->totalCount;
    }
    $right_total = $left_total = 0;
    for ($i = 0; $i < $length; $i++) {
        $row = array();
        if (isset($wallet_details_left[$i])) {
            $row[] = $wallet_details_left[$i]['name'];
            $row[] = $wallet_details_left[$i]['payable'];
            if ($wallet_details_left[$i]['is_paid'] > 0) {
                $row[] = 'Success';
            } else {
                $row[] = 'Pending';
            }
            $left_total = (float) $left_total + (float) $wallet_details_left[$i]['payable'];
        } else {
            $row[] = 'Nil';
            $row[] = 'Nil';
            $row[] = 'Nil';
        }
        if (isset($wallet_details_right[$i])) {
            $row[] = $wallet_details_right[$i]['name'];
            $row[] = $wallet_details_right[$i]['payable'];
            if ($wallet_details_right[$i]['is_paid'] > 0) {
                $row[] = 'Success';
            } else {
                $row[] = 'Pending';
            }
            $right_total = (float) $right_total + (float) $wallet_details_right[$i]['payable'];
        } else {
            $row[] = 'Nil';
            $row[] = 'Nil';
            $row[] = 'Nil';
        }
        $data[] = $row;
    }
    $row = array();
    $row[] = 'Totals( 15% Of  amount will cut off as tax,admin charges )';
    $row[] = $left_total;
    $row[] = '';
    $row[] = '';
    $row[] = $right_total;
    $row[] = '';
    $data[] = $row;

    $output = array(
        "draw" => $_REQUEST['draw'],
        "recordsTotal" => $length,
        "recordsFiltered" => $length,
        "data" => $data,
    );

    echo json_encode($output);
});

Flight::route('/admin/customer/getcustomerlist', function() {
    require 'config/config.php';
    $user = $_SESSION['user'];
    $stat = $_REQUEST['stat'];
    $type = $user['userRole'];
    $sesion_uuid = $user['uuid'];
    $uuid = $_REQUEST['uuid'];
    $start = $_REQUEST['length'];
    /* get start number from page */
    $skip = $_REQUEST['start'];
    /* get search string from page */
    $search = $_REQUEST['search'];
    /* Listing columns */
    $arraycolums = array('a.name', 'a.mobile', 'b.package', 'a.leg');
    /* if search string is  present added to the conditon */
    if ($search['value'] != '') {
        $db->where(implode(" like ('%" . $search['value'] . "%') or  ", $arraycolums), '%' . $search['value'] . '%', 'like');
    }
    if ($type == 'user' || $uuid != $sesion_uuid) {
        $db->where("parent", $uuid);
    }
    $txt = '';
    $join = 'left';
    if ((int) $stat > 0) {
        $join = 'inner';
        $txt = ' and IFNULL(rightcount,0) >0 and IFNULL(leftcount,0)>0';
    }
    /* Oder By */
    $sort = $_REQUEST['order'];
    if ($sort[0]['column'] < sizeof($arraycolums)) {
        $db->orderBy($arraycolums[$sort[0]['column']], $sort[0]['dir']);
    } else {
        $db->orderBy("a.userId", "desc");
    }
    /* get correct data */
    $assets = $db->withTotalCount()->get("customers as a inner join packages as b on a.packageId=b.uuid " . $join . " join (SELECT paymentuseruuid,count(case paymentuserLeg when 'Left' then 1 else null end) as leftcount,count(case paymentuserLeg when 'Right' then 1 else null end) as rightcount FROM `customer_tree` WHERE is_paid=0 GROUP by paymentuseruuid) as cnt on cnt.paymentuseruuid =a.uuid " . $txt . " ", Array($skip, $start), 'IFNULL(leftcount,0) as leftcount,IFNULL(rightcount,0) as rightcount,a.total_paid_amount,a.total_consumed,a.userId,a.uuid,' . implode(",", $arraycolums));
    //echo $db->getLastQuery(); 
    $total = $db->totalCount;
    /* Create JSON for datatable */
    $data = array();

    foreach ($assets as $item) {
        $row = array();
        foreach ($arraycolums as $singlecolumn) {
            $out = explode(".", $singlecolumn);
            $row[] = $item[$out[1]];
        }
//        $act  = '<a  href="' . $base_url . 'customer/register/' . $item['userId'] . '" title="Edit" data-toggle="tooltip" class="btn btn-sm btn-success "><span class="fa fa-pencil-square-o"></span></a>';
        $act = '';
        $act = $act . '&nbsp;<a  style="width:120px;" href="' . $base_url . 'admin/customer/list_all/' . $item['uuid'] . '" title="Edit" data-toggle="tooltip" class="btn btn-sm btn-success ">List Childs</a>';
        if ($type == 'admin') {
            if ((int) $item['leftcount'] > 0 && (int) $item['rightcount'] > 0) {
                $act = $act . '&nbsp;<a  style="width:120px;" href="' . $base_url . 'admin/customer/wallet/' . $item['uuid'] . '" title="Edit" data-toggle="tooltip" class="btn btn-sm btn-info ">Set Wallet</a>';
            }
        }
        if ($type == 'admin') {
            $act = $act . '&nbsp;<a customer_uuid="' . $item['uuid'] . '" style="width:120px;" href="#" title="Edit" data-toggle="tooltip" class="pay btn btn-sm btn-warning ">Money Transfer</a>';
        }

        if ($type == 'admin') {
            $row[] = round($item['total_paid_amount'] - $item['total_consumed'], 2);
            $row[] = $item['leftcount'];
            $row[] = $item['rightcount'];
        }
        $row[] = $act;
        $data[] = $row;
    }
    $output = array(
        "draw" => $_REQUEST['draw'],
        "recordsTotal" => $total,
        "recordsFiltered" => $total,
        "data" => $data,
    );

    echo json_encode($output);
});


Flight::route('/admin/customer/support_list', function() {
    require 'config/config.php';
    $sess_user = $_SESSION['user'];
    $start = $_REQUEST['length'];
    /* get start number from page */
    $skip = $_REQUEST['start'];
    $user_role = $sess_user['userRole'];
    $uuid = $sess_user['uuid'];
    if ($user_role == 'user') {
        $db->where("customer_uuid", $uuid);
    }
    if (isset($_REQUEST['status'])) {
        if ($_REQUEST['status'] != '') {
            $db->where("status", $_REQUEST['status']);
        }
    }
    $customer_support = $db->withTotalCount()->get(" customer_support as a inner join customers as b on a.customer_uuid=b.uuid", Array($skip, $start), "b.name,b.mobile,a.message,a.id,status,a.replay");
    $total = $db->totalCount;
    $data = array();
    for ($i = 0; $i < $total; $i++) {
        $row = array();
        if ($user_role == 'admin') {
            $row[] = $customer_support[$i]['name'];
            $row[] = $customer_support[$i]['mobile'];
        }
        $row[] = $customer_support[$i]['message'];
        $row[] = $customer_support[$i]['replay'];
        $row[] = $customer_support[$i]['status'];
        if ($user_role == 'admin') {
            $act = ' <a tp="confirm"   support_id="' . $customer_support[$i]['id'] . '"  data-toggle="tooltip" title="Replay" type="button" class="btn btn-warning replay" data-toggle="modal" data-target="#replaymodal">Replay</span></a>';
            $act = $act . ' <a tp="confirm"   support_id="' . $customer_support[$i]['id'] . '"  data-toggle="tooltip" title="Change Status" type="button" class="btn btn-warning change_stat" data-toggle="modal" data-target="#statusmodal">Change Status</span></a>';
            $row[] = $act;
        }
        $data[] = $row;
    }
    $output = array(
        "draw" => $_REQUEST['draw'],
        "recordsTotal" => $total,
        "recordsFiltered" => $total,
        "data" => $data,
    );

    echo json_encode($output);
});

Flight::route('/admin/customer/support', function() {
    require 'config/config.php';
    $sess_user = $_SESSION['user'];
    $uuid = $sess_user['uuid'];
    $user_role = $sess_user['userRole'];
    include 'views/admin/_hedder.php';
    include 'views/admin/support.php';
    include 'views/admin/_footer.php';
});

Flight::route('/admin/customer/list_bonus', function() {
    require 'config/config.php';
    $sess_user = $_SESSION['user'];
    $uuid = $sess_user['uuid'];
    include 'views/admin/_hedder.php';
    include 'views/admin/customer_bonus_list.php';
    include 'views/admin/_footer.php';
});

Flight::route('/terms', function() {
    require 'config/config.php';
    $sess_user = $_SESSION['user'];
    $uuid = $sess_user['uuid'];
    include 'views/admin/_hedder.php';
    include 'views/admin/terms.php';
    include 'views/admin/_footer.php';
});

Flight::route('/admin/customer/list_all(/@uuid)', function($uuid) {
    $id = $uuid;
    require 'config/config.php';
    $sess_user = $_SESSION['user'];
    include 'views/admin/_hedder.php';
    include 'views/admin/customer_list.php';
    include 'views/admin/_footer.php';
});
Flight::route('/customer/getallchild(/@uuid(/@leg))', function($uuid, $leg) {
    require 'config/config.php';
    $id = $uuid;
    $customer_childs = $db->get(" (select * from customers order by `parent_id`, `userId`) folders_sorted, (select @pv := " . $uuid . ") initialisation where find_in_set(`parent_id`, @pv) > 0 and @pv := concat(@pv, ',', `userId`) GROUP by parent_id", null, 'GROUP_CONCAT(`userId`) as userId,GROUP_CONCAT(name) as name, `parent_id`,GROUP_CONCAT(uuid) as parent,GROUP_CONCAT(leg) as leg,parent as parentid');
    echo json_encode($customer_childs);
});
Flight::route('/customer/tree(/@uuid)', function($uuid) {
    require 'config/config.php';
    $sess_user = $_SESSION['user'];
    $uuid = $sess_user['userId'];
    $customer_childs = $db->get(" (select * from customers order by `parent_id`, `userId`) folders_sorted, (select @pv := 3) initialisation where find_in_set(`parent_id`, @pv) > 0 and @pv := concat(@pv, ',', `userId`) GROUP by parent_id", null, 'GROUP_CONCAT(`userId`) as userId,GROUP_CONCAT(name) as name, `parent_id`,parent,GROUP_CONCAT(leg) as leg');
    include 'views/admin/_hedder.php';
    include 'views/customer_tree.php';
    include 'views/admin/_footer.php';
});

Flight::route('/emailvalidation', function() {
    require 'config/config.php';


    $response = array(
        'valid' => false,
        'message' => 'Post argument "email" is missing.'
    );

    if (isset($_POST['email'])) {

        $db->where("email", $_POST['email']);
        $user = $db->get("customers");
        if ($user) {
            // User name is registered on another account
            $response = array('valid' => false, 'message' => $_POST['email'] . ' is already registered.');
        } else {
            // User name is available
            $response = array('valid' => true);
        }
    }
    echo json_encode($response);
});
Flight::route('/phonevalidation', function() {
    require 'config/config.php';


    $response = array(
        'valid' => false,
        'message' => 'Post argument "phone number" is missing.'
    );

    if (isset($_POST['phone'])) {

        $db->where("mobile", $_POST['phone']);
        $user = $db->get("customers");
        if ($user) {
            // User name is registered on another account
            $response = array('valid' => false, 'message' => $_POST['phone'] . ' is already registered.');
        } else {
            // User name is available
            $response = array('valid' => true);
        }
    }
    echo json_encode($response);
});


Flight::route('/admin/customer/wallet(/@uuid)', function($uuid) {
    require 'config/config.php';
    session_check();
    $sess_user = $_SESSION['user'];
    $user__role = $sess_user['userRole'];
    if ($user__role == 'admin') {
        $db->where("paymentuseruuid", $uuid);
        $db->where("is_paid", 0);
        $db->where("paymentuserLeg", 'Left');
        $wallet_details_left = $db->get(" `customer_tree` as a INNER JOIN customers as b on a.createduseruuid=b.uuid", null, "b.name,a.amount,a.percentage,b.uuid,a.paymentuseruuid,paymentuserLeg,ROUND((a.amount*a.percentage)/100,2) as payable");
        $db->where("paymentuseruuid", $uuid);
        $db->where("is_paid", 0);
        $db->where("paymentuserLeg", 'Right');
        $wallet_details_right = $db->get(" `customer_tree` as a INNER JOIN customers as b on a.createduseruuid=b.uuid", null, "b.name,a.amount,a.percentage,b.uuid,a.paymentuseruuid,paymentuserLeg,ROUND((a.amount*a.percentage)/100,2) as payable");
        include 'views/admin/_hedder.php';
        include 'views/customer_wallet.php';
        include 'views/admin/_footer.php';
    } else {
        
    }
});


Flight::route('/actionregistercustomer', function() {
    require 'config/config.php';
    session_check();
    $sess_user = $_SESSION['user'];
    $sessionuuid = $sess_user['uuid'];
    $parent = $_REQUEST['uuid'];
    $db->where("uuid", $parent);
    $parent_customer = $db->get("customers");
    $parent_id = $parent_customer[0]['userId'];
    $leg = $_REQUEST['leg'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $phone = $_REQUEST['phone'];
    $password = $_REQUEST['password'];
    $package = $_REQUEST['package'];
    $packageamount = $_REQUEST['packageamount'];
    $settings = $db->getOne('settings');
    $primary = $settings['primary_precentage'];
    $secondary = $settings['secondary_percentage'];
    $data = array(
        'name' => $name,
        'email' => $email,
        'packageId' => $package,
        'parent' => $parent,
        'parent_id' => $parent_id,
        'leg' => $leg,
        'mobile' => $phone,
        'userRole' => 'user',
        'password' => $password,
        'password' => $password,
        'packageamount' => $packageamount
    );
    if (empty($_REQUEST['customer_uuid'])) {
        $data['uuid'] = $uuid5->toString();
        $createduseruuid = $data['uuid'];
        $id = $db->insert("customers", $data);
        $data_amount = array(
            'total_consumed' => $db->inc($packageamount)
        );
        $customer_parents = $db->get(" ( SELECT @r AS _id, (SELECT @r := parent_id FROM customers WHERE userId = _id) AS parent_id, @l := @l + 1 AS lvl FROM (SELECT @r := " . $id . ", @l := 0) vars, customers h WHERE @r <> 0) T1 JOIN customers T2 ON T1._id = T2.userId where T2.userId!=" . $id . " ORDER BY T1.lvl asc", null, "T2.userId, T2.name,T2.uuid,leg");
        $length = sizeof($customer_parents);
        $db->where("uuid", $sessionuuid);
        $db->update("customers", $data_amount);
        print_r($customer_parents);
        for ($i = 0; $i < $length; $i++) {
            $data = $data = array(
                'createduserId' => $id,
                'createdby' => $sessionuuid,
                'paymentuserId' => $customer_parents[$i]['userId'],
                'paymentuseruuid' => $customer_parents[$i]['uuid'],
                'createduseruuid' => $createduseruuid,
                'amount' => $packageamount,
                'paymentuserLeg' => $leg,
                'date' => date('Y-m-d H:i:s', time()),
                'is_paid' => 0,
                'total_paid' => 0
            );
            if ($i < 1) {
                $data['paymentuserLeg'] = $leg;
                $data['percentage'] = $primary;
            } else {
                $data['paymentuserLeg'] = $customer_parents[$i - 1]['leg'];
                $data['percentage'] = $primary;
            }
            $db->insert("customer_tree", $data);
        }
		$paid_amount = 50;
		$data_amount = array(
            'total_paid_amount' => $db->inc($paid_amount)
        );
		$db->where("uuid", $sessionuuid);
        $db->update("customers", $data_amount);

//        foreach ($customer_parents as $sm) {
//            $data = array(
//                'createduserId' => $id,
//                'createdby' => $parent,
//                'paymentuserId' => $sm['userId'],
//                'paymentuseruuid' => $sm['uuid'],
//                'createduseruuid' => $createduseruuid,
//                'amount' => $packageamount,
//                'paymentuserLeg' => $sm['leg'],
//                'date' => date('Y-m-d H:i:s', time()),
//                'is_paid' => 0,
//                'total_paid' => 0
//            );
//            $db->insert("customer_tree", $data);
//        }
    } else {
        $db->where("uuid", $_REQUEST['customer_uuid']);
        $id = $db->update("customers", $data);
    }
});
?>