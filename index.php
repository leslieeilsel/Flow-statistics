<?php include './logic/php/index.php';?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--定时跳转页面，单位‘秒’-->
    <meta http-equiv="refresh" content="300;url=index1.php">
    <link rel="shortcut icon" href="./logic/icon/favicon.ico">
    <link rel="stylesheet" href="./logic/css/time.css" type="text/css" />
    <script src="http://cdn.staticfile.org/echarts/3.5.0/echarts.min.js"></script>
    <script src="http://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="./logic/js/time.js"></script>
    <title>图书馆人流监测</title>
    </style>
</head>
<body onload="getTime();setInterval('refresh()',5000)">
	<div style="width:100%;height:30px;z-index:1;position:absolute;">
		<div id="date1"></div>
	</div>
    <div id="chartDiv1">
        <div id="perCountBar" style="width: 49%;height:100%;float:left;"></div>
        <div id="perPercentPie" style="width: 49%;height:50%;float:left"></div>
        <div id="typePercentPie" style="width: 49%;height:50%;float:left"></div>
    </div>
    <script type="text/javascript">
        height = $(window).height();         //可视窗口的高度
        width = $(window).width();
        $('#chartDiv1').css('height',height);//设置高度属性
        $('#chartDiv1').css('width',width);
        
        var deptCountChart = echarts.init(document.getElementById('perCountBar'));

        var deptArr = <?php echo json_encode($deptArr);?>;
        var deptCountArr = <?php echo json_encode($deptCountArr);?>;
 
        // deptCountChart.showLoading(); //预加载动画
        var deptoption = {
            title : {
            text: '图书馆实时访问人数',
                x:'center',
                textStyle: {
                    fontSize: 25 //设置字体大小
                }
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: { // 坐标轴指示器，坐标轴触发有效
                    type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            // legend: {
            //     data: ['访问人数']
            // },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            yAxis: [{
                // name: '学院',
                type: 'category',
                data: deptArr,
                axisLabel: {
                    textStyle: {
                        color: '#000',
                        fontSize: 14  //设置y轴字体
                    }
                },
                axisTick: {
                    alignWithLabel: true
                }
            }],
            xAxis: [{
                // name: '访问人数',
                type: 'value',
                axisLabel: {
                    show: true,
                    textStyle: {
                        color: '#000',
                        fontSize: 14  //设置x轴字体
                    }
                }
            }],
            backgroundColor: '#ffffff',
            series: [{
                name: '访问人数',
                type: 'bar',
                animationDuration: 1500,
                animationEasing: 'exponentialInOut',
                data: deptCountArr,
                label: {
                    normal: {
                        show: true,
                        position: 'insideRight',
                        textStyle: {
                            color: 'white'
                        }
                    }
                },
                itemStyle: {
                    normal: {
                        color: function (params) {
                            // 每列设置不同的颜色
                            var colorList = [
                                '#18569d', '#1a5d9d', '#1d649d', '#1f6b9d', '#22729e', '#24799e', '#27809e', '#29879f', '#2c8e9f',
                                '#2e959f', '#319c9f', '#33a3a0', '#36aaa0', '#38b1a0', '#3bb8a1', '#3dbfa1', '#40c6a1', '#43cea2'
                            ];
                            return colorList[params.dataIndex];
                        }
                    }
                }
            }]
        }
        deptCountChart.setOption(deptoption);

        var deptPercentChart = echarts.init(document.getElementById('perPercentPie'));
        var deptPercentArrTen = <?php echo json_encode($deptPercentArrTen);?>;
        typeoption = {
            title : {
                text: '最近十天学院人数占比',
                // subtext: '纯属虚构',
                x: 'left',
                textStyle: {
                    fontSize: 25 //设置字体大小
                }
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} 人 ({d} %)"
            },
            // legend: {
            //     orient: 'vertical',
            //     left: 'left',
            //     data: deptArr
            // },
            series : [
                {
                    name: '访问人数',
                    type: 'pie',
                    // minAngle: 10,// 最小角度
                    radius : '72%',
                    animationType: 'scale',
                    /* 
                    * roseType:是否展示成南丁格尔图，通过半径区分数据大小。可选择两种模式：
                    * 'radius' 扇区圆心角展现数据的百分比，半径展现数据的大小。
                    * 'area' 所有扇区圆心角相同，仅通过半径展现数据大小。
                    */
                    // roseType: 'radius',
                    animationEasing: 'exponentialInOut',
                    animationDuration: 1500,
                    center: ['50%', '50%'],
                    data: deptPercentArrTen,
                    itemStyle: {
                        normal: {
                            color: function (params) {
                                // 每列设置不同的颜色
                                var colorList = [
                                        '#228fbd', '#BA55D3', '#20B2AA', '#e08031', '#c7ceb2', '#7c8489', '#ee827c', '#c8c8a9', '#83af9b',
                                        '#c97586', '#495a80', '#5ca7ba', '#199475', '#e36868', '#376956', '#b57795', '#6e8631'
                                    ];
                                return colorList[params.dataIndex];
                            }
                        }
                    },
                    label: {
                        normal: {
                            textStyle: {
                                fontSize: 15, //设置字体大小
                                color: '#000'
                            },
                            formatter: "{b} ( {d} % )"
                        }
                    },
                    labelLine: {
                        normal: {
                            smooth: true,
                            lineStyle: {
                                color: '#3c3c3c'
                            }
                        }
                    }
                }
            ]
        };
        deptPercentChart.setOption(typeoption);
        
        var typePercentChart = echarts.init(document.getElementById('typePercentPie'));
        var typeArr = <?php echo json_encode($typeArr);?>;
        var typePercentArr = <?php echo json_encode($typePercentArr);?>;
        typepercentoption = {
            title : {
                text: '最近十天学位人数占比',
                // subtext: '纯属虚构',
                x: 'left',
                textStyle: {
                    fontSize: 25 //设置字体大小
                }
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} 人 ({d} %)"
            },
            // legend: {
            //     orient: 'vertical',
            //     left: 'left',
            //     data: typeArr
            // },
            series : [
                {
                    name: '访问人数',
                    type: 'pie',
                    radius : '72%',
                    center: ['50%', '50%'],
                    animationType: 'scale',
                    animationEasing:'exponentialInOut',
                    animationDuration: 1500,
                    minAngle: 10,// 最小角度
                    data: typePercentArr,
                    itemStyle: {
                        normal: {
                            color: function (params) {
                                // 每列设置不同的颜色
                                var colorList = [
                                    '#bfad86', '#94b38f', '#f5be33', '#e36868', '#a3bac2', '#7c8489',
                                ];
                                return colorList[params.dataIndex];
                            }
                        }
                    },
                    label: {
                        normal: {
                            textStyle: {
                                fontSize: 15, //设置字体大小
                                color: '#000'
                            },
                            formatter: "{b} ( {d} % )"
                        }
                    },
                    labelLine: {
                        normal: {
                            smooth: true,
                            lineStyle: {
                                color: '#3c3c3c'
                            }
                        }
                    }
                }
            ]
        };
        typePercentChart.setOption(typepercentoption);

        var urlList = ['./logic/php/deptCount.php', './logic/php/deptPercent.php', './logic/php/typePercent.php'];          
        function refresh(){
            for(var i = 0; i < urlList.length; i++){
                $.ajax({ 
                    type: "post", 
                    async: false, //同步执行 
                    url: urlList[i], 
                    dataType: "json", //返回数据形式为json 
                    success: function(result) { 
                        // alert(urlList[i]);
                        // myChart.hideLoading(); //隐藏加载动画 
                        switch(i)
                        {
                            case 0:
                                deptCountChart.setOption({
                                    yAxis: [{
                                        // name: '学院',
                                        type: 'category',
                                        data: result.deptArr,
                                        axisLabel: {
                                            textStyle: {
                                                color: '#000',
                                                fontSize: 14  //设置y轴字体
                                            }
                                        },
                                        axisTick: {
                                            alignWithLabel: true
                                        }
                                    }],
                                    series: [{
                                        name: '访问人数',
                                        data: result.deptPercentArr,
                                    }] //渲染数据
                                });
                                break;
                            case 1:
                                deptPercentChart.setOption({
                                    series: [{
                                        name: '访问人数',
                                        data: result,
                                    }] //渲染数据
                                });
                                break;
                            case 2:
                                typePercentChart.setOption({
                                    series: [{
                                        name: '访问人数',
                                        data: result,
                                    }] //渲染数据
                                });
                                break;
                        }
                    }, 
                    error: function() { 
                        alert("error" + i); 
                    } 
                });
            }
        }
    </script>
</body>
</html>