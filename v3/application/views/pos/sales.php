<style>
    .btn-app img {
        width: 120px;
        height: 98px;
    }
    .btntxt{
        word-wrap: break-word;
        white-space: initial;
        max-width: 100px;
        min-height: 25px;
        max-height: 56px;
        overflow: hidden;
        font-size: 14px; 
        text-align: justify;
    }
    .info-box-text {
        text-transform: capitalize !important;
        word-wrap: break-word;
        white-space: initial; 
        max-height: 40px;
        overflow: hidden; 
    }
    .price{
        height: 25px;
    }

    .num tbody tr td{
        height: 40px;

    }
    .num tbody tr td button{
        width: 100%;
        text-align: center; 
        font-size: medium;
        font-weight: bold; 
        height: 40px !important;
        vertical-align: middle;
    }
    .click {
        width: 120px;
        height: 100px;
        border: 2px solid;
        padding-left: 10px;
        padding-top: 4px;
        margin: 3px;
        border-color: #e6e6e6;
        background: #e6e6e6;
        border-radius: 16px;
    }
    .btnrte{
        bottom: 0px; 
        font-weight: 800;
        font-size: 16px; 
    }

    .click:hover {
        background-color: #3e8e41;
        color:#fff;
    }

    .click:active {
        background-color: #3e8e41;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
    }

    .scrolling-wrapper {
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap; 
        .card {
            display: inline-block;
        }
    } 
    .sidenav {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 9999999999999;
        top: 0;
        right: 0;
        background-color: #eee;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top:30px;
    }

    .sidenav  ul {
        list-style: none;
        padding: 3px;
    }

    .sidenav ul li {
        display: inline-block;
        padding-top: 5px;
        width: 100%;
    }
    .btnsb{
        height: 30px !important;
        width: 100%;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 30px;
        margin-left: 50px;
    }

    tr.highlight {
        background: rgb(170, 170, 170)!important;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 25px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
    }
    .fullscreen .content{
        padding: 0px !important;
        margin: 0px !important;
    }

    .btn-full-app {
        border-radius: 3px !important;
        padding: 5px 5px !important;
        height: auto !important;
        position: relative; 
        margin: 0 0 10px 10px;
        min-width: 80px;
        height: 60px;
        text-align: center;
        color: #666;
        border: 1px solid #ddd;
        background-color: #f4f4f4;
        font-size: 12px;
    }
    .info-box-text {
        display: block;
        font-weight: bold;
        font-size: 13px;
    }
    .m5{
        margin: 5px;
    }
</style>
<script src="<?php echo base_url(); ?>assets/js/vue.js"></script>
<div id="myvideo">  
    <section class="content"> 
        <div class="box"> 
            <div class="box-body"> 
            <input id ="sid" name ="sid" type ="hidden" value = "<?php echo $id;?>" />
			<a style="display:none" tp="new" target="_blank" id="salesbills" href="#" >Print bill</a>
                <div class="row">   
                    <div class="col-xs-12">
                        <div class="nav-tabs-custom" id="tab-list"> 
                            <ul class="nav nav-tabs" id="nav-tabs"> 
                                <li  class="pull-right">  
                                    <div>
                                        <a class="btn btn-full-app" id="add" ><i class="fa fa-plus"></i></a>  
                                        <button type="button"   id="fullsc" class="btn btn-full-app"> fullsc</button> 
                                    </div>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content"  >
                                <!-- Font Awesome Icons -->
                                <div class="tab-pane hidden" id="mainSalecs">  
                                    <div class="box-body"> 
                                        <div  class="col-sm-5 col-md-6 col-lg-4 no-padding"> 
                                            <div>
                                                <table class="table table-striped" style="font-size: 12px; font-weight: bold">
                                                    <thead>
                                                        <tr class="bg-light-blue">
                                                            <th class="col-md-6">Name</th>      
                                                            <th class="col-md-2">Qty</th>
                                                            <th class="col-md-2">FQty</th>
                                                            <th class="col-md-2">Total</th> 
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div style="height: 45vh; overflow:auto" > 
                                                <table class="table table-striped" style="font-size: 12px; font-weight: bold">
                                                    <tr  v-for="singlordeprd in ordproducts" v-bind:class="{'highlight': (singlordeprd.id == selecteditem.id)}" v-on:click="selected(singlordeprd)"> 
                                                        <td class="col-md-8">  
                                                            {{singlordeprd.name}} 
                                                            <br/>                                                    
                                                            <span style="font-size: 10px; font-weight: bold">  {{ singlordeprd.qty}} X ({{ singlordeprd.srate}} -{{singlordeprd.disc }}) </span>
                                                            <br/>
                                                            <span style="font-size: 10px; font-weight: bold"> MRP- {{ singlordeprd.MRP}}</span>
                                                        </td>  
                                                        <td class="col-md-2"> {{ (singlordeprd.qty).toFixed(2)}}</td>
                                                        <td class="col-md-2"> 0</td>
        <!--                                                <td> <input class="form-control text-right  two-digits price"  v-model="singlordeprd.qty" placeholder="Qty"></td>-->
                                                        <td class="col-md-2"> {{ (singlordeprd.qty * (singlordeprd.srate -singlordeprd.disc)).toFixed(2)}}</td> 
                                                    </tr> 

                                                </table>
                                            </div>
                                            <div > 
                                                <div class="col-sm-12">

                                                    <table class="table" style="font-size: 12px; font-weight: bold">
                                                        <tr >
                                                            <td>No Items</td>
                                                            <td>{{ ordproducts.length}}</td>
                                                            <td>Total</td>
                                                            <td  class="text-right">{{ gettotal }}</td>
                                                        </tr>
														 <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Disc</td>
                                                            <td class="text-right">{{ getdiscount }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Tax</td>
                                                            <td class="text-right">{{ gettax }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Net</td>
                                                            <td class="text-right">{{ getnettotal }}</td>
                                                        </tr>
                                                    </table>

                                                </div>
                                            </div>
                                            <div>  
                                                <div class="col-sm-4 no-padding">


                                                </div>
                                                <div class="col-sm-8 no-padding"> 
                                                    <table class="num table table-bordered" >
                                                        <tbody>
                                                            <tr>
                                                                <td class="col-md-3"> <button   v-on:click="changeval('1')" class="btn btn-default">1 </button> </td>
                                                                <td class="col-md-3"> <button   v-on:click="changeval('2')" class="btn btn-default">2 </button> </td>
                                                                <td class="col-md-3"> <button   v-on:click="changeval('3')" class="btn btn-default">3 </button> </td>
                                                                <td class="col-md-3"> <button  v-bind:class="{ 'btn-primary':(selectedtype === 'qty')}" class="btn btn-default"  v-on:click="selectedtp('qty')">QTY </button> </td>
                                                            </tr> 
                                                            <tr>
                                                                <td> <button class="btn btn-default" v-on:click="changeval('4')">4 </button> </td>
                                                                <td> <button class="btn btn-default" v-on:click="changeval('5')">5 </button> </td>
                                                                <td> <button class="btn btn-default" v-on:click="changeval('6')">6 </button> </td>
                                                                <td> <button class="btn btn-default"  v-bind:class="{ 'btn-primary':(selectedtype === 'disc')}"  v-on:click="selectedtp('disc')">Disc </button> </td>
                                                            </tr> 
                                                            <tr>
                                                                <td> <button class="btn btn-default" v-on:click="changeval('7')">7 </button> </td>
                                                                <td> <button class="btn btn-default" v-on:click="changeval('8')">8 </button> </td>
                                                                <td> <button class="btn btn-default" v-on:click="changeval('9')">9</button> </td>
                                                                <td> <button class="btn btn-default"  v-bind:class="{ 'btn-primary':(selectedtype === 'price')}" v-on:click="selectedtp('price')">Price </button> </td>
                                                            </tr> 
                                                            <tr>
                                                                <td> <button class="btn btn-default">+/- </button> </td>
                                                                <td> <button class="btn btn-default" v-on:click="changeval('0')">0 </button> </td>
                                                                <td> <button class="btn btn-default" v-on:click="changeval('.')">. </button> </td>
                                                                <td> <button class="btn btn-default" v-on:click="clearval()" v-bind:class="{ 'btn-primary':(selectedtype === 'back')}"> <i class="glyphicon glyphicon-arrow-left"></i> </button> </td>
                                                            </tr> 
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>

                                        <div  class="col-sm-7 col-md-6 col-lg-8" >
                                            <div class="sidenav"  v-bind:style="{ width: sideboxwidth }">
                                                <a class="closebtn"  v-on:click="closeNav"  >&times;</a>
                                                <ul>
                                                    <li><button type="button" class="btn btn-primary btnsb" v-on:click="catclick(0)" >All</button> </li>
                                                    <li   v-for="singlecat in itemscategory">
                                                        <button type="button" class="btn btn-primary btnsb" v-on:click="catclick(singlecat.id)">{{ singlecat.name }}</button> 
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="row bg-light-blue" style="padding: 4px; border-color: #aaa;">
                                                <div class="pull-right col-lg-4 ">
                                                    <div class="input-group">
                                                        <input type="text"  v-model="searchtxtbc" @change="searchbarcode" class="form-control" placeholder="Search...">
                                                        <span class="input-group-btn">
                                                            <button type="button" name="searchbarcode"   class="btn btn-flat"><i class="fa fa-search"></i>
                                                            </button>
                                                            <button type="button" v-on:click="openNav"   class="btn btn-flat">&#9776;
                                                            </button>
                                                        </span>

                                                    </div>
                                                </div>
                                                <div class="col-lg-4"> 
                                                    <!--                                            <a class="btn card btn-default" v-for="singlecat in itemscategory" v-on:click="getsubcategory(singlecat.id)"  >{{ singlecat.name }}</a>-->
                                                </div>
                                                <div class="pull-right col-lg-4 ">
                                                    <div class="input-group">
                                                        <input type="text"  v-model="searchtxt" @change="search" class="form-control" placeholder="Search...">
                                                        <span class="input-group-btn">
                                                            <button type="button" name="search"   class="btn btn-flat"><i class="fa fa-search"></i>
                                                            </button> 
                                                        </span>

                                                    </div>
                                                </div>
                                            </div> 
                                            <div>
                                                <div class="box-body"> 
                                                    <div class="row"   v-bind:class="{ 'hidden':(viewtype !== 'items')}" style="height:60vh;overflow-y: scroll">
                                                        <div v-for="singleprd in products"  v-on:click="say(singleprd)">
                                                            <div class="col-md-3" style="padding: 3px !important;height: 150px">
                                                                <div class="box box-default   box-solid" >
                                                                    <div class="box-header bg-light-blue with-border" style="    height: 70px;">
                                                                        <h3 class="box-title" style="font-size: 15px;">{{ singleprd.name }}</h3>
                                                                    </div> 
                                                                    <div class="box-body" style="height: 72px">
                                                                        <span class="info-box-text">S-Rate:{{ singleprd.srate }}</span>
                                                                        <span class="info-box-text">MRP :{{ singleprd.MRP }}</span>

                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row"  v-bind:class="{ 'hidden':(viewtype !== 'payment')}">
                                                        <div class="box box-primary   box-solid" style="padding: 0px;margin:0px">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title" >Payment & Customer Details</h3> 
                                                            </div>
                                                            <!-- /.box-header -->
                                                            <div class="box-body"> 
                                                                <div class="col-md-6">
                                                                    <div class="row">

                                                                        <div class="col-sm-3">
                                                                            <label>Cash</label>
                                                                            <label class="switch">
                                                                                <input v-bind:name="getName('CashType')" v-model="paymentType"    checked="checked" value="cash" type="radio">
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <label>Card</label>
                                                                            <label class="switch">
                                                                                <input v-bind:name="getName('CashType')"  v-model="paymentType"    value="card"  type="radio">
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label>Cash & Card</label>
                                                                            <br/>
                                                                            <label class="switch">
                                                                                <input  v-bind:name="getName('CashType')"  v-model="paymentType"  value="cashcard" type="radio">
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </div>

                                                                      <!--  <div class="col-sm-6">
                                                                            <label>Credit</label>
                                                                            <br/>
                                                                            <label class="switch">
                                                                                <input  v-bind:name="getName('CashType')"  v-model="paymentType"  value="credit" type="radio">
                                                                                <span class="slider round"></span>
                                                                            </label>
                                                                        </div>-->

                                                                    </div>  
                                                                    <div class="row m5 "  v-show="paymentType != 'card' && paymentType != 'credit'">
                                                                        <label class="control-label col-sm-6">Cash</label>
                                                                        <div class="col-sm-6"> 
                                                                            <input type="text" id="cash_amt" class="form-control"    v-model="cashAmount" placeholder="Cash ">
                                                                        </div>

                                                                    </div>

                                                                    <div class="row m5 "  v-show="paymentType != 'cash' && paymentType != 'credit' ">
                                                                        <label class="control-label col-sm-6">Card Amount</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control" id="card_amt"   v-model="cardAmount"  placeholder="Card Amount">
                                                                        </div>
                                                                    </div>  
                                                                    <div class="row m5  "  v-show="paymentType != 'cash' && paymentType != 'credit'">
                                                                        <label class="control-label col-sm-6">Card Number</label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control"  v-model="cardNO"  placeholder="Card Number">
                                                                        </div>
                                                                    </div> 


                                                                </div> 
                                                                <div class="col-md-6 ">
                                                                    <div class="row m5" >
                                                                        <label class="control-label col-sm-4">Customer </label>
                                                                        <div class="col-sm-8"> 
                                                                            <input type="text"  class="form-control"   v-model="name" placeholder="Name ">
                                                                        </div>

                                                                    </div>
                                                                    <div class="row m5" >
                                                                        <label class="control-label col-sm-4">Phone </label>
                                                                        <div class="col-sm-8"> 
                                                                            <input type="text"  class="form-control"   v-model="phone" placeholder="Phone Number">
                                                                        </div>

                                                                    </div>
                                                                    <div class="row m5" >
                                                                        <label class="control-label col-sm-4">Email </label>
                                                                        <div class="col-sm-8"> 
                                                                            <input type="text"  class="form-control"   v-model="email" placeholder="Email ">
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>




                                                        <div  style ="display:none;" class="box box-primary   box-solid" style="padding: 0px;margin:0px">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title" >Search Exixting Customer</h3> 
                                                            </div>
                                                            <!-- /.box-header -->
                                                            <div class="box-body"> 
                                                                
                                                                <div class="col-md-12 ">
                                                                    <br />
                                                                    <div class="row m5" >
                                                                        <label class="control-label col-sm-4">Customer </label>
                                                                        <div class="col-sm-8"> 
                                                                            <input type="text"  class="form-control"   v-model="searchname" @keydown ="searchcustomer" placeholder="Name ">
                                                                        </div>

                                                                    </div>
                                                                   
                                                                </div>

                                                                <div class="row"    style="height:60vh;overflow-y: scroll">
                                                                    <div v-for="singleprd in customerdata"  v-on:click="say(singleprd)">
                                                                        <div class="col-md-3" style="padding: 3px !important;height: 150px">
                                                                            <div class="box box-default   box-solid" >
                                                                                <div class="box-header bg-light-blue with-border" style="    height: 70px;">
                                                                                    <h3 class="box-title" style="font-size: 15px;">{{ singleprd.name }}</h3>
                                                                                </div> 
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        
                                                    </div>
                                                    <br/>
                                                    <div class="row">

                                                        <div class="box box-primary box-solid" style="padding: 0px;margin:0px">
                                                            <div class="box-header with-border">
                                                                <h3 class="box-title" >Order Details</h3> 
                                                            </div>
                                                            <!-- /.box-header -->
                                                            <div class="box-body"> 
                                                                <div class="row">
                                                                    <div class="col-md-4"> 
                                                                        <a  v-bind:class="{ 'hidden':(viewtype == 'payment')}" class="btn btn-app" v-on:click="payclick">
                        <!--                                                    <span class="badge bg-purple">891</span>-->
                                                                            <i class="fa fa-send"></i> Pay
                                                                        </a> 
                                                                        <a v-bind:class="{ 'hidden':(viewtype !== 'payment')}" class="btn btn-app" v-on:click="saveAll">
                      <!--                                                    <span class="badge bg-purple">891</span>-->
                                                                            <i class="fa fa-send"></i> Saved
                                                                        </a> 
                                                                        <a v-bind:class="{ 'hidden':(viewtype !== 'payment')}" class="btn" v-on:click="payback">
                      <!--                                                    <span class="badge bg-purple">891</span>-->
                                                                            <i class=""></i> Back
                                                                        </a> 
                                                                    </div>
                                                                    <div class="col-md-4 ">
                                                                        <table>
                                                                            <tr>
                                                                                <td>Cash Paid </td>
                                                                                <td>{{ cashAmount }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Balance</td>
                                                                                <td>{{ getBalance }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Net Amount</td>
                                                                                <td>{{ getnettotal }}</td>
                                                                            </tr>
                                                                        </table> 

                                                                    </div>
                                                                    <div class="col-md-4 ">
                                                                        <table>
                                                                            <tr>
                                                                                <td>Cash Amount</td>
                                                                                <td>{{ getCash }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Net Amount</td>
                                                                                <td>{{ getnettotal }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Net Amount</td>
                                                                                <td>{{ getnettotal }}</td>
                                                                            </tr>
                                                                        </table> 

                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <!-- /.box-body -->
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>


                                    </div> 
                                </div>  
                            </div>  
                        </div> 
                    </div> 
                </div> 

            </div> 

        </div>
    </section>  
</div>
<script>


function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
</script>
<script type = "text/javascript">

    var id = 1;
    var elem = document.getElementById("myvideo");

    /* When the openFullscreen() function is executed, open the video in fullscreen.
     Note that we must include prefixes for different browsers, as they don't support the requestFullscreen method yet */
    function openFullscreen() {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { /* Firefox */
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { /* IE/Edge */
            elem.msRequestFullscreen();
        }
    }

    function closeFullscreen() {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
    }
    $(document).ready(function () {

		
        $('#add').click(function () {
            var length = $('ul#nav-tabs li').length;
            id = length;
            if (id <= 10) {
                sm();
            }

        });

        $('#fullsc').click(function () {
            var txt = $(this).text();
            if (txt === 'fullsc') {
                $('#myvideo').addClass('fullscreen');
                $(this).text('Normal');
                openFullscreen();
            } else {
                $('#myvideo').removeClass('fullscreen');
                $(this).text('fullsc');
                closeFullscreen();
            }

        });
        $('#tab-list').on('click', '.close', function () {
            var tabID = $(this).parents('a').attr('href');
            $(this).parents('li').remove();
            $(tabID).remove();
//display first tab
            var tabFirst = $('#tab-list a:first');
            resetTab();
            tabFirst.tab('show');
        });
        var sid = $('#sid').val();
        sm(sid);
    });
    var button = '<button class="close" type="button" title="Remove this page">×</button>';
    var tabID = 1;
    function resetTab() {
        var tabs = $("#tab-list li:not(:first)");
        var len = 1
        $(tabs).each(function (k, v) {
            len++;
//$(this).find('a').html('Tab ' + len + button);
        })
        tabID--;
    }
    function sm(sid = 0) {

        var str = ' <li><a href="#mainSale' + id + '" data-toggle="tab"> POS ' + id + '</a></li>';
//    if (id > 1) {
//        str = ' <li><a href="#mainSale' + id + '" data-toggle="tab"> Pos Sale ' + id + ' <button class="close" type="button" title="Remove this page">×</button> </a></li>';
//
//    }
        $('#nav-tabs').append(str);
        var mainhtml = $('#mainSalecs').html();
        mainhtml = '<div class="tab-pane active" id="mainSale' + id + '">' + mainhtml + '</div>';
        $('#tab-content').append(mainhtml);
        this[id + '_count'] = new Vue({
            el: "#mainSale" + id,
            data: {
                sideboxwidth: '0px',
                products: [],
                ordproducts: [],
                itemscategory: [],
                itemssubcategory: [],
                customerdata:[],
				sales_id:'',
                searchtxt: '',
                searchname:'',
                customer: 'jijo',
                searchtxtbc: '',
                cashAmount: 0.00,
                selecteditem: {},
                selectedtype: {},
                paymentType: 'cash',
                chngval: '',
                index: id,
                name: '',
                phone: '',
                email: '',
                cardNO: '',
                cardAmount: 0.00,
                viewtype: 'items' /* Default view type is Items */
            },
            mounted: function () {
                var self = this;
                $.ajax({
                    url: '<?php echo base_url(); ?>pos/main/getproducts',
                    method: 'GET',
                    success: function (data) {
                        var result = JSON.parse(data);
                        self.products = result.products;
                        self.itemscategory = result.categories;
                        console.log(self.itemscategory)
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
                if(parseFloat(sid) > 0){ 
                    $.ajax({
                        url: '<?php echo base_url(); ?>pos/main/getsalesdata/'+sid,
                        async:false,
                        method: 'GET',
                        success: function (data) {

                            datas = JSON.parse(data);
                            self.sales_id = datas[0].sales_id;
                            this.cardNO = datas[0].card_no;
                            this.name = datas[0].cusname;
                            this.email = datas[0].cusemail;
                            this.phone = datas[0].cusdetails;
                            this.paymentType = datas[0].cash_type;
                            this.cashAmount=datas[0].cash_amount;
                            this.cardAmount = datas[0].bank_amount;
                            self.ordproducts = datas;
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }

            }, computed: {
                gettotal: function () {
					
                    var totalamount = 0.00;
                    $.each(this.ordproducts, function (key, value) {
                        totalamount = parseFloat(totalamount) + parseFloat(value.qty) * parseFloat(value.srate);
                    });
                    return totalamount.toFixed(0);
                },
				getdiscount: function () {
					
                    var totaldiscount = 0.00;
                    $.each(this.ordproducts, function (key, value) {
                        totaldiscount = parseFloat(totaldiscount) + parseFloat(value.disc);
                    });
                    return totaldiscount.toFixed(2);
                },
				gettax: function () {
					
                   var totalamount = 0.00;
				   var taxtotal = 0;
                    $.each(this.ordproducts, function (key, value) {
						var taxamount = 0;
						var GST =value.GST;
						var rowtotal = parseFloat(value.qty) * parseFloat(value.srate) - parseFloat(value.disc);
                        totalamount = parseFloat(totalamount) + parseFloat(value.qty) * parseFloat(value.srate) - parseFloat(value.disc);
						if(parseFloat(rowtotal) > 0 && parseFloat(GST)>0){
							taxamount = parseFloat(rowtotal)*parseFloat(GST)/100;
						}
						taxtotal = parseFloat(taxtotal)+parseFloat(taxamount);
                    });
                    return taxtotal.toFixed(2);
                },
				getnettotal: function () {
					
                   var totalamount = 0.00;
				   var taxtotal = 0;
                    $.each(this.ordproducts, function (key, value) {
						var taxamount = 0;
						var GST =value.GST;
						var rowtotal = parseFloat(value.qty) * parseFloat(value.srate) - parseFloat(value.disc);
                        totalamount = parseFloat(totalamount) + parseFloat(value.qty) * parseFloat(value.srate) - parseFloat(value.disc);
						if(parseFloat(rowtotal) > 0 && parseFloat(GST)>0){
							taxamount = parseFloat(rowtotal)*parseFloat(GST)/100;
						}
						taxtotal = parseFloat(taxtotal)+parseFloat(taxamount);
                    });
					totalamount = parseFloat(totalamount) + parseFloat(taxtotal);
                    return totalamount.toFixed(0);
                },
                getCash: function () {
                    var cashAmount = 0;
                    if (this.paymentType !== 'credit'){ 
                     var cashAmount = (this.getnettotal - this.cardAmount).toFixed(2);
                    }
                    return cashAmount;
                },
                getBalance: function () {
                    if (this.paymentType === 'cash')
                    { 
						this.cashAmount = this.getnettotal;
						this.cardAmount = 0;
                        var cashAmount = (this.getnettotal - this.cashAmount).toFixed(2);
                        return cashAmount;
                    } else
                    if (this.paymentType === 'card')
                    {
						this.cashAmount = 0;
						this.cardAmount = this.getnettotal;
                        var cashAmount = (this.getnettotal - this.cardAmount).toFixed(2);
                        return cashAmount;
                    }
                    else
                    if (this.paymentType === 'credit')
                    {
						return this.getnettotal;
                    }  else
                    {
						if(this.cardAmount >0 || this.cashAmount>0){
							if(cardAmount > 0){
								var cashAmount =(this.getnettotal - this.cardAmount).toFixed(2);
								this.cashAmount = cashAmount;
							}else{
								var cardAmount =(this.getnettotal - this.cashAmount).toFixed(2);
								this.cardAmount = cardAmount;
							}
							var cashAmount = (this.getnettotal - this.cardAmount - this.cashAmount).toFixed(2);
						}else{
							this.cashAmount = this.getnettotal;
							var cashAmount = (this.getnettotal - this.cardAmount - this.cashAmount).toFixed(2);
						}
                        
                  
                        return cashAmount;
                    }
                },
                getmrp: function () {
                    var totalamount = 0.00;
                    $.each(this.ordproducts, function (key, value) {
                        totalamount = parseFloat(totalamount) + parseFloat(value.MRP);
                    });
                    return totalamount.toFixed(2);
                }
            },
            methods: {
                say: function (item) { 
					var tax_total = 0;
					var rowtotal = parseFloat(item.srate);
					if(parseFloat(item.GST) > 0 && parseFloat(item.srate) >0){
						tax_total = parseFloat(item.srate)*parseFloat(item.GST)/100;
						rowtotal = parseFloat(rowtotal) + parseFloat(tax_total);
					}
                    let sm = {index: this.index, disc: 0.00, name: item.name, id: item.id, srate: item.srate, MRP: item.MRP, qty: 1.0,tax_id:item.tax_id,GST:item.GST,tax_total:tax_total,rowtotal:rowtotal};
                    this.index = this.index + 1;
                    this.ordproducts.push(sm);
                },
                selected: function (item) {
                    this.selecteditem = item;
                    this.chngval = '';
                },
                getName: function (name) {
                    return name + '' + this.index;
                },
                selectedtp: function (type) {
                    this.chngval = '';
                    this.selectedtype = type;
                },
                saveAll: function () {
					var sales_id = this.sales_id;
                    console.log(this.ordproducts);
                    console.log(this.name);
                    console.log(this.name);
					$.ajax({
						url: '<?php echo site_url('pos/Main/save'); ?>',
						type: 'post',
						async:false,
						data: {sales_id:sales_id,ordproducts:this.ordproducts,customer:this.name,email:this.email,phone:this.phone,paymentType:this.paymentType,cashAmount:this.cashAmount,cardAmount:this.cardAmount,cardNO:this.cardNO},
						success: function(response) {
							var json = JSON.parse(response);
							sales_id =json.id;
                            window.open('<?php echo site_url('transaction/sales/bill/'); ?>'+sales_id+'/1', '_blank');
							$('#add').trigger('click');
                            $('#salesbills').attr('href','<?php echo site_url('transaction/sales/bill/'); ?>'+sales_id+'/1');
							$('#salesbills').trigger('click');
						}
					});
					this.sales_id = sales_id;
                    this.viewtype = 'items';
                },
                getsubcategory: function (id) {
                    var self = this;
                    $.ajax({
                        url: '<?php echo base_url(); ?>pos/main/getsubactegory/' + id,
                        method: 'GET',
                        success: function (data) {
                            var result = JSON.parse(data);
                            self.itemssubcategory = result.subcategories;
                            console.log(self.itemssubcategory)
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                },
                payclick: function () {
                    this.viewtype = 'payment';
                },
                payback: function () {
                    this.viewtype = 'items';
                },
                paymentcompleted: function () {
                    this.viewtype = 'items';
                },
                catclick: function (id) {
                    var self = this;
                    $.ajax({
                        url: '<?php echo base_url(); ?>pos/main/getitems/' + id,
                        method: 'GET',
                        success: function (data) {
                            var result = JSON.parse(data)
                            self.products = result.products;
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                },
                openNav: function () {
                    this.sideboxwidth = "200px";
                },
                closeNav: function () {
                    this.sideboxwidth = "0px";
                },
                changeval: function (val) {
                    this.chngval = this.chngval + val;
                    let self = this;
                    $.each(this.ordproducts, function (key, value) {
                        if (self.selecteditem.index === value.index) {
                            if (self.selectedtype === 'qty') {
                                value.qty = parseFloat(self.chngval);
								
                            }
                            if (self.selectedtype === 'price') {
                                value.srate = parseFloat(self.chngval);
                            }
                            if (self.selectedtype === 'disc') {
                                value.disc = parseFloat(self.chngval);
                            }
                            value.tax_id = value.tax_id;
							var GST = value.GST;
							var qty = value.qty;
							var srate = value.srate;
							var disc = value.disc;
							if(parseFloat(qty)>0 && parseFloat(srate)>0 && parseFloat(GST)>0){
								var totalamount = parseFloat(qty) * parseFloat(srate) - parseFloat(disc);
								tax_total =  parseFloat(totalamount)*parseFloat(GST)/100;
								value.tax_total = parseFloat(tax_total);
								var rowtotal = parseFloat(totalamount) + parseFloat(tax_total);
								value.rowtotal = parseFloat(rowtotal);
							}else{
								value.tax_total = 0;
								var rowtotal = parseFloat(qty) * parseFloat(srate) - parseFloat(disc);
								value.rowtotal = parseFloat(rowtotal);
							}
                        }
                    });
                },
                clearval: function () {
                    let self = this;
                    if (self.chngval === '') {
                        let index = this.ordproducts.indexOf(self.selecteditem);
                        this.ordproducts.splice(index, 1);
                    }
                },
                search: function () {
                    var self = this;
                    $.ajax({
                        url: '<?php echo base_url(); ?>pos/main/getproducts/' + this.searchtxt,
                        method: 'GET',
                        success: function (data) {
                            var result = JSON.parse(data);
                            self.products = result.products;
                            console.log(result.products);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                },
                searchbarcode: function () {
                    var self = this;
                    $.ajax({
                        url: '<?php echo base_url(); ?>pos/main/getproductsbc/' + this.searchtxtbc,
                        method: 'GET',
                        success: function (data) {
                            var result = JSON.parse(data);
                            self.products = result.products;
                            console.log(result.products);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                },
                searchcustomer: function () {
                    var self = this;
                    $.ajax({
                        url: '<?php echo base_url(); ?>pos/main/getcustomer/' + this.searchname,
                        method: 'GET',
                        success: function (data) {
                            var result = JSON.parse(data);
                            self.customerdata = result.customerdata;
                            console.log(result.customerdata);
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }
            }
        });
        $('.nav-tabs a[href="#mainSale' + id + '"]').tab('show');
    }
    function catsale() {
        var str = ' <li><a href="#catsale' + id + '" data-toggle="tab"> Pos Sale</a></li>';
    }
</script>