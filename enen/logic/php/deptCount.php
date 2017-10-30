<?php
    /*设置时区*/
    date_default_timezone_set('PRC');
    
    /*连接数据库*/
    require './database.php';
    $db = new PDO($dbName, $dbUser, $dbPassword);

    /*学院实时来访人数*/
    $deptCountSql = $db->query("SELECT dept,count(dept) as deptcnt FROM dbo.chart WHERE datediff(day,VisitTime,getdate()) = 0 and dept !=N'未知部门' GROUP BY dept ORDER BY deptcnt ASC"); //排序 ORDER BY deptcnt ASC
    $dept = $deptCountSql->fetchAll(PDO::FETCH_ASSOC);
    $deptArr = [];
    $deptCountArr = [];
    $deptPercent = [];
    $deptPercentArr = [];
    if (!empty($dept)) {
        foreach($dept as $v){
            $xueyuan = '';
            $xueyuan = substr($v['dept'], -6);
            if ($xueyuan == '学院') {
                $deptArr[] = $v['dept'];
                $deptCountArr[] = $v['deptcnt'];
                $deptPercent['name'] = $v['dept'];
                $deptPercent['value'] = $v['deptcnt'];
                $deptPercentArr[] = $deptPercent;
            }
        }
    }
    echo json_encode(['deptArr'=>$deptArr,'deptPercentArr'=>$deptPercentArr]);
