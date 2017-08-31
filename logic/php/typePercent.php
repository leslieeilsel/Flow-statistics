<?php
    /*设置时区*/
    date_default_timezone_set('PRC');
    /*连接数据库*/
    require 'database.php';
    $db = new PDO($dbName, $dbUser, $dbPassword);
    /*最近十天 学位人数占比(包括今天)*/
    $typeCountSql = $db->query("SELECT type,count(type) as typecnt FROM RTPass WHERE datediff(day,VisitTime,getdate())<= 9 and datediff(day,VisitTime,getdate())>= 0 and dept !='未知部门' GROUP BY type ORDER BY typecnt ASC"); //排序 ORDER BY typecnt ASC
    $typeCount = $typeCountSql->fetchAll(PDO::FETCH_ASSOC);
    $typeArr = [];
    $typeCountArr = [];
    $typePercent = [];
    $typePercentArr = [];
if(!empty($typeCount)) {
    foreach($typeCount as $v){
        $sheng = '';
        $sheng = substr($v['type'], -3);
        if ($sheng == '生') {
            $typeArr[] = $v['type'];
            $typeCountArr[] = $v['typecnt'];
            $typePercent['name'] = $v['type'];
            $typePercent['value'] = $v['typecnt'];
            $typePercentArr[] = $typePercent;
        }
    }
}

    // sqlsrv_free_stmt($typeCountSql);
    // sqlsrv_close($db);

    echo json_encode($typePercentArr);
