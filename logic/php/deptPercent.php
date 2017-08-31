<?php
    /*设置时区*/
    date_default_timezone_set('PRC');
    /*连接数据库*/
    require 'database.php';
    $db = new PDO($dbName, $dbUser, $dbPassword);
    /*最近十天 学院人数占比(包括今天)*/
    $deptCountSqlTen = $db->query("SELECT dept,count(dept) as deptcnt FROM [dbo].[RTPass] WHERE datediff(day,VisitTime,getdate())<= 9 and datediff(day,VisitTime,getdate())>= 0 and dept !='未知部门' GROUP BY dept"); //排序 ORDER BY deptcnt ASC
    $deptTen = $deptCountSqlTen->fetchAll(PDO::FETCH_ASSOC);
    $deptArrTen = [];
    $deptCountArrTen = [];
    $deptPercentTen = [];
    $deptPercentArrTen = [];
if (!empty($deptTen)) {
    foreach($deptTen as $v){
        $xueyuanTen = '';
        $xueyuanTen = substr($v['dept'], -6);
        if ($xueyuanTen == '学院') {
            $deptArrTen[] = $v['dept'];
            $deptCountArrTen[] = $v['deptcnt'];
            $deptPercentTen['name'] = $v['dept'];
            $deptPercentTen['value'] = $v['deptcnt'];
            $deptPercentArrTen[] = $deptPercentTen;
        }
    }
}

    // sqlsrv_free_stmt($deptCountSqlTen);
    // sqlsrv_close($db);

    echo json_encode($deptPercentArrTen);
