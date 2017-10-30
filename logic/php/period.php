<?php
    /*设置时区*/
    date_default_timezone_set('PRC');
    /*连接数据库*/
    require 'database.php';
    $db = new PDO($dbName, $dbUser, $dbPassword);

    /*当日分时段人数统计*/
    $hour = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:30', '18:00', '19:00', '20:00', '21:00', '22:00'];
    $dateTimess = [
        ['07:00:00.000','07:59:59.000'],
        ['08:00:00.000','08:59:59.000'],
        ['09:00:00.000','09:59:59.000'],
        ['10:00:00.000','10:59:59.000'],
        ['11:00:00.000','11:59:59.000'],
        ['12:00:00.000','12:59:59.000'],
        ['13:00:00.000','13:59:59.000'],
        ['14:00:00.000','14:59:59.000'],
        ['15:00:00.000','15:59:59.000'],
        ['16:00:00.000','16:59:59.000'],
        ['17:00:00.000','17:59:59.000'],
        ['18:00:00.000','18:59:59.000'],
        ['19:00:00.000','19:59:59.000'],
        ['20:00:00.000','20:59:59.000'],
        ['21:00:00.000','21:59:59.000']
    ];
    $data = [];
    foreach ($dateTimess as $key => $datetime) {
        $period = $db->query("SELECT count(*) as cnt FROM dbo.chart WHERE VisitTime BETWEEN '".date('Y-m-d')." ".$datetime[0]."' AND '".date('Y-m-d')." ".$datetime[1]."'and dept !=N'未知部门'");
        $periodDatas = $period->fetchAll(PDO::FETCH_ASSOC);
        $data[] = $periodDatas[0]['cnt'];
    }
    foreach ($data as $key => $value) {
        if ($value == '0') {
            $data[$key] = '';
        }
    }

    echo json_encode(['hour'=>$hour,'data'=>$data]);