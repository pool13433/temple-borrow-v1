<!DOCTYPE html>
<html>
    <head>
        <title>Temple Borrow 2014 ระบบยืม คืน ของวัด เหล่าอ้อย</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php
        include '../../config/app_function.php';
        ?>
        <link href="../../bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="../../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>

        <!--  date picker-->        
        <link href="../../datepicker/css/datepicker.css" rel="stylesheet"/>        

        <link href="../../datatables/dataTables.css" rel="stylesheet"/> 

        <link href="../../css/borrow_style.css" rel="stylesheet"/>

        <script type="text/javascript" src="../../js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="../../bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../datepicker/js/bootstrap-datepicker.js"></script>

        <script type="text/javascript" src="../../datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../../datatables/jquery-DT-pagination.js"></script>

        <script type="text/javascript" src="../../js/borrow_script.js"></script>
    </head>   
    <body>
        <div class="container-fluid" style="margin-top: 20px;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="jumbotron alert alert-link">
                        <h1>โปรแกรม ยืมคืน วัสดุ</h1>
                        <p>กรณีศึกษา วัดเหล่าอ้อย</p>
                    </div>
                </div>
                <div class="panel-body" style="margin: auto;">
                    <div class="col-md-2">         
                        <?php include './menu_left.php'; ?>
                    </div>
                    <div class="col-md-10">
                        <?php
                        // ตรวจสอบ ค่า ว่ามีการส่งค่ามาหรือเปล่า
                        if (!empty($_GET)) {  // มีค่า
                            $page = $_GET['page'] . '.php';
                            if (file_exists($page)) {
                                include $page;
                            } else {
                                echo alert_message('danger', 'ไม่พบ หน้าเว็บ ที่เรียกหา Error 404');
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="panel-footer">

                </div>
            </div>
        </div>
    </body>
</html>