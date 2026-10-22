 
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small></small>
    </h1> 
</section> 
<section class="content"> 
   <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-bar-chart"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">Companies</span>
                        <span class="info-box-number">90<small>%</small></span>
                    </div>
    
                </div>
    
            </div>
    
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-grain"></i></span>
    
                    <div class="info-box-content">
                        <span class="info-box-text">Subscriptions</span>
                        <span class="info-box-number"></span>
                    </div>
    
                </div>
    
            </div>
    
            <div class="clearfix visible-sm-block"></div>
    
         
    
        </div>  
     
</section>

   <script type="text/javascript">

        $(document).ready(function () {
            load(); 
        });
        

        function load() {
            
//                $.ajax({
//                    url: "<?php echo site_url('dashboard/getsales'); ?>/",
//                    success: function (results) {
//                        var result = JSON.parse(results);
//                        $("#sales").val(result.stotal);
//                       
//                        
//                    }
//                });
            }
    </script>
 