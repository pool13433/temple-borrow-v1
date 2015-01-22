<!DOCTYPE html>
<html>
    <head>
        <title>Temple Borrow 2014 ระบบยืม คืน ของวัด เหล่าอ้อย</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php
        @ob_start();
        @session_start();
        include '../../config/app_function.php';
        ?>
        <link href="../../libs/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="../../libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>

        <!--  date picker-->        
        <link href="../../libs/datepicker/css/datepicker.css" rel="stylesheet"/>        

        <link href="../../libs/datatables/dataTables.css" rel="stylesheet"/> 

        <link href="../../css/borrow_style.css" rel="stylesheet"/>

        <script type="text/javascript" src="../../js/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="../../libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../libs/datepicker/js/bootstrap-datepicker.js"></script>

        <script type="text/javascript" src="../../libs/datatables/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../../libs/datatables/jquery-DT-pagination.js"></script>

        <!-- validate engine-->
        <link rel="stylesheet" href="../../libs/validationengine/css/validationEngine.jquery.css"/>
        <script type="text/javascript" src="../../libs/validationengine/js/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="../../libs/validationengine/js/languages/jquery.validationEngine-en.js"></script>
        <!-- validate engine-->
        
        <script type="text/javascript" src="../../js/borrow_script.js"></script>

    </head>   
    <body>
        <?php include './menu_top.php'; ?>
        <div class="container" style="margin-top: 50px;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="jumbotron alert alert-link">
                        <h1>ระบบบริหารจัดการของวัด</h1>
                        <p>กรณีศึกษา วัดเหล่าอ้อย</p>
                    </div>
                </div>
                <div class="panel-body" id="content" style="margin: auto;">
                    <?php
                    $page = $_GET['page'] . '.php';
                    if (empty($_SESSION['person'])):
                        goLogin();
                    else:
                        if (!empty($_GET)) {  // มีค่า
                            if (file_exists($page)) {
                                include $page;
                            } else {
                                echo alert_message('danger', 'ไม่พบ หน้าเว็บ ที่เรียกหา Error 404');
                            }
                        }
                    endif;

                    // ตรวจสอบ ค่า ว่ามีการส่งค่ามาหรือเปล่า
                    ?>
                </div>
                <div class="panel-footer">

                </div>
            </div>
        </div>
    </body>
</html>