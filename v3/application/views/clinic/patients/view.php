<form method="post"  id="frmcreate"  action="<?php echo site_url('clinic/Booking/printcertificate'); ?>">
    <input type="hidden"  id="name" name="name"/>  
    <input type="hidden" value="<?php echo $patient['Pat_Id']; ?>" id="id" name="id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">

                        <h4 id="pat_name" name="pat_name" class="profile-username text-center"></h4>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Age</b> <a id="age" name="age" class="pull-right"></a>
                            </li>
                            <li class="list-group-item">
                                <b>Gender</b> <a id="gender" name="gender" class="pull-right"></a>
                            </li>
                            <li class="list-group-item">
                                <b>Date Of Birth</b> <a name="dob" id="dob" class="pull-right"></a>
                            </li>

                            <li class="list-group-item">
                                <b>Address</b> <a id="address" name="address" class="pull-right"></a><br/><br/>
                            </li>
                            <li class="list-group-item">
                                <b>Phone</b> <a id="phone" name="phone" class="pull-right"></a>
                            </li>
                        </ul>

                        <a href="<?php echo site_url('clinic/booking/create'); ?>" class="btn btn-primary btn-block"><b>Book Appointment</b></a>
                        <a tp="pdf" id="cay" href="<?php echo site_url('clinic/booking/certificate/carry/'); ?>" class="btn btn-primary btn-block"><b>MEDICINE CARRY CERTIFICATE</b></a>
                        <a tp="pdf" id="fts" href="<?php echo site_url('clinic/booking/certificate/fitness/'); ?>" class="btn btn-primary btn-block"><b>FITNESS CERTIFICATE</b></a>
                        <a tp="pdf" id="mdl" href="<?php echo site_url('clinic/booking/certificate/medical/'); ?>" class="btn btn-primary btn-block"><b>MEDICAL CERTIFICATE</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <!--  <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li> -->
                        <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                        <li><a href="#fitness" data-toggle="tab">Certificate</a></li>
<!--                        <li><a href="#medical" data-toggle="tab">Medical</a></li>-->
<!--                        <li><a href="#carry" data-toggle="tab">Medycarry</a></li>-->
                    </ul>
                    <div class="tab-content">
                        <!-- <div class="active tab-pane" id="activity"> 
                            
                        </div> -->
                        <!-- /.tab-pane -->
                        <div class="active tab-pane" id="timeline">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                                <!-- timeline time label -->
                               <?php foreach ($details as $item) { ?>
                                    <li class="time-label">
                                        <span class="bg-red"> <?php echo $item['Bok_Date'] ?>  </span>

                                    </li>       
                                    <li>
                                        <i class="fa fa-envelope bg-blue"></i>

                                        <div class="timeline-item">  
                                            <h3 class="timeline-header"><a href="#">Observations & Diagnosis</a> </h3>
                                            <div class="timeline-body">
                                                <b>Observations   :</b>   <?php echo $item['Bok_DocNote'] ?> <br></br> 
                                                <b>Diagnosis      :</b>   <?php echo $item['Bok_DoctDescription'] ?> <br></br>
                                                <b>Lab Notes      :</b>   <?php echo $item['Bok_Labnote'] ?> <br></br>
                                                <b>Doctor's Notes    :</b>   <?php echo $item['Bok_Summery'] ?> <br></br>
                                            </div>
                                            <h3 class="timeline-header"><a href="#">Prescription</a> </h3>
                                            <div class="timeline-body">
                                                <?php echo $item['Pre_note']; ?> <br></br>   
                                            </div>  
                                        </div>
                                    </li>
                                <?php } ?>  



                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane" id="fitness">
                            <div class="box-body">
                                <table class="table table-striped table-condensed" >
                                    <tr>
                                        <td class="hunpx"> Type</td>
                                        <td class="hunpx">Date</td>
                                        <td class="hunpx">End Date</td>
                                    </tr>
                                    <tr>
                                        <td class="col-lg-3"><select tabindex="-1"   name="type" data-validation="required" id="type"  class="form-control" >
                                                <option value="fitness">Fitness</option> 
                                                <option value="medical">Medical</option> 
                                                <option value="carry">MedyCarry</option> 
                                            </select> 
                                        </td>
                                        <td class="col-lg-3">  <input name="date" type="text" id="date" data-validation="required" class="form-control  date" placeholder="Date"></td>
                                        <td class="col-lg-3">  <input name="enddate" type="text" id="rdate" data-validation="required"    class="form-control date" placeholder="Enddate"></td>


                                    </tr>
                                    <tr>
                                        <td class="hunpx">Institution</td>
                                        <td class="hunpx">Reside</td>
                                        <td class="hunpx">Place</td>
                                    </tr>
                                    <tr>
                                        <td><input name="institution"   id="institution" type="text" NoTab="true"      class="form-control" placeholder="Institution"></td>   
                                        <td><input name="reside"   id="reside" type="text" NoTab="true"        class="form-control" placeholder="Reside"></td>   
                                        <td><input name="place"   id="place" type="text" NoTab="true"      class="form-control" placeholder="Place"></td>   
                                    </tr>
                                </table>
                                <br>
                                <br>
<!--                                <button id="printcer" name="printcer" type='button'   title='Save' class='btn bg-blue btn-print'> <i class="glyphicon glyphicon-print"></i> </button>                                  -->
                                <a tp="pdf" data-toggle="tooltip" style="float: left"
                                   title="Print" id="printcer" class="btn btn-success"
                                   href="#"> <span class="glyphicon glyphicon-print"></span>
                                </a>

                            </div>

                        </div>
                        <div class="tab-pane" id="medical">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <?php foreach ($details as $item) { ?>
                                    <li class="time-label">
                                        <span class="bg-red"><?php echo $item['Bok_Date'] ?></span>

                                    </li>       
                                    <li>
                                        <i class="fa fa-envelope bg-blue"></i>

                                        <div class="timeline-item">  
                                            <h3 class="timeline-header"><a href="#">Observations</a> </h3>
                                            <div class="timeline-body">
                                                <?php echo $item['Bok_DocNote'] ?><br></br>   
                                            </div>
                                            <h3 class="timeline-header"><a href="#">Diagonise</a> </h3>
                                            <div class="timeline-body">
                                                <?php echo $item['Bok_DoctDescription'] ?> <br></br>   
                                            </div>
                                            <h3 class="timeline-header"><a href="#">Prescription</a> </h3>
                                            <div class="timeline-body">
                                                <?php echo $item['Bok_Priscription'] ?><br></br>   
                                            </div>  
                                        </div>
                                    </li>
                                <?php } ?>


                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane" id="carry">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <?php foreach ($details as $item) { ?>
                                    <li class="time-label">
                                        <span class="bg-red"><?php echo $item['Bok_Date'] ?></span>

                                    </li>       
                                    <li>
                                        <i class="fa fa-envelope bg-blue"></i>

                                        <div class="timeline-item">  
                                            <h3 class="timeline-header"><a href="#">Observations</a> </h3>
                                            <div class="timeline-body">
                                                <?php echo $item['Bok_DocNote'] ?><br></br>   
                                            </div>
                                            <h3 class="timeline-header"><a href="#">Diagonise</a> </h3>
                                            <div class="timeline-body">
                                                <?php echo $item['Bok_DoctDescription'] ?> <br></br>   
                                            </div>
                                            <h3 class="timeline-header"><a href="#">Prescription</a> </h3>
                                            <div class="timeline-body">
                                                <?php echo $item['Bok_Priscription'] ?><br></br>   
                                            </div>  
                                        </div>
                                    </li>
                                <?php } ?>


                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </section>
    <script type="text/javascript">

        $(document).ready(function () {

            load();
        });
        function DobtoAge(agesaved)
                            {
                                var today = new Date();
                                var bdate=$('#dob').html();
                                array = bdate.split('/');
                                var newDate = array[1] + "/" + array[0] + "/" + array[2];
                                var birthDate = new Date(newDate);
                                var age = today.getFullYear() - birthDate.getFullYear();
                                if(agesaved>age)
                                {
                                    age = agesaved;
                                }
                                var m = today.getMonth() - birthDate.getDay();
//                                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
//                                    age--;
//                                }
                                $('#age').html(age);
                            }
                            function formatDate(input) {
                                var datePart = input.match(/\d+/g),
                                        year = datePart[0].substring(2), // get only two digits
                                        month = datePart[1], day = datePart[2];

                                return day + '/' + month + '/' + year;
                            }
        $("#fts").attr('disabled', 'disabled');
        $("#cay").attr('disabled', 'disabled');
        $("#mdl").attr('disabled', 'disabled');
        $('#printcer').click(function () {
            var type = $("#type").val();
            var date = $("#date").val();
            date = date.replace("/", "-");
            date = date.replace("/", "-");
            var enddate = $("#rdate").val();
            enddate = enddate.replace("/", "-");
            enddate = enddate.replace("/", "-");
            var institution = $("#institution").val();
            var reside = $("#reside").val();

            var place = $("#place").val();
            var id = $("#id").val();
            /*$.ajax({
             url: '<?php echo site_url('clinic/Booking/printcertificate') ?>', //This is the current doc
             type: "POST",
             data: {'date': date, 'enddate': enddate, 'institution': institution, 'reside': reside, 'place': place, 'id': id , 'type': type},
             success: function () {
             //                location.reload();
             }
             });*/
            if (institution != "") {
                $("#fts").attr('href', '<?php echo site_url('clinic/booking/certificate/fitness/'); ?>' + id + '/' + institution + '/' + date + '/' + enddate + '/' + place);
                $("#fts").removeAttr('disabled');
            }
            if (reside != "") {

                $("#cay").attr('href', '<?php echo site_url('clinic/booking/certificate/carry/'); ?>' + id + '/' + reside + '/' + date + '/' + enddate + '/' + place);
                $("#cay").removeAttr('disabled');
            }
            $("#mdl").attr('href', '<?php echo site_url('clinic/booking/certificate/medical/'); ?>' + id + '/' + date + '/' + enddate + '/' + institution + '/' + place);
            $("#mdl").removeAttr('disabled');

        });
        function printcertificate() {
            var date = $("#date").val();
            var enddate = $("#enddate").val();
            var institution = $("#institution").val();
            var reside = $("#reside").val();
            var place = $("#place").val();
            var id = $("#id").val();
            $.ajax({
                url: '<?php echo site_url('clinic/Booking/printcertificate') ?>', //This is the current doc
                type: "POST",
                data: {'date': date, 'enddate': enddate, 'institution': institution, 'reside': reside, 'place': place, 'id': id},
                success: function () {
                    //                location.reload();
                }
            });
        }
        function load() {
                                var id = $("#id").val();
                                //alert(id);
                                if (id > 0) {
                                    $.ajax({
                                        url: "<?php echo site_url('clinic/patients/getsing'); ?>/" + id,
                                        success: function (results) {
                                            var result = JSON.parse(results);
                                            $("#pat_name").html(result.Pat_Name);
                                            $("#phone").html(result.Pat_Phone);
                                            $("#gender").html(result.Pat_Gender);
                                            if (result.Pat_Dob != '0000-00-00') {
                                                $('#dob').html(formatDate(result.Pat_Dob));
                                                DobtoAge(result.Pat_Age);
                                            }
                                           //$("#age").val(result.Pat_Age);
                                            $("#address").html(result.Pat_Address);
                                        }
                                    });
                                }
                            }
    </script>