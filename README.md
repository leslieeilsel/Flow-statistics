# Flow-statistics 系统搭建
## 一、搭建运行环境 ##
1. 安装 [PHPstudy](http://www.phpstudy.net/download.html "前往下载") (Apache + PHP + MySQL)<br />
![](http://a2.qpic.cn/psb?/V12ol6gx2nrILn/Z0SoCX.WYyqHWZHJN7HzfxUL1oz*hAUwSuIV6CLYc3c!/b/dPcAAAAAAAAA&bo=6APOAegDzgERCT4!&rf=viewer_4)

2. 安装 [vc14运行库](http://www.xdowns.com/soft/184/dll/2016/Soft_164980.html "前往下载")<br />
![](http://a3.qpic.cn/psb?/V12ol6gx2nrILn/7rp77zWgzf4gJOARIkwmCX.ihE6vmLZDhcvrNdIW2Yk!/b/dLMAAAAAAAAA&bo=5QEsAeUBLAERCT4!&rf=viewer_4)
3. 安装 [ODBC Driver 11 For SQL （msodbcsql.msi）](https://www.microsoft.com/en-us/download/details.aspx?id=36434 "前往下载")<br />
![](http://a3.qpic.cn/psb?/V12ol6gx2nrILn/mvwIrZgIAHVZ5Jt6keV7IlyAehVjbhN.tH.nzQ2Wn8Y!/b/dEQAAAAAAAAA&bo=.AGSAfgBkgERADc!&rf=viewer_4)
4. 将php-7.0.12-NTS添加到系统环境变量，并在php.ini中插入如下两行：

	`extension=php_pdo_sqlsrv_7_ts_x86.dll` <br />
	`extension=php_sqlsrv_7_ts_x86.dll`
![](http://a1.qpic.cn/psb?/V12ol6gx2nrILn/xpzvico1bXrsUpA*26ob1eLYw9QNse8gV2hg2rcd7Us!/b/dPkAAAAAAAAA&bo=0gJYAdICWAERADc!&rf=viewer_4)
5. 保存修改，重启PHPstudy，运行phpinfo(),查看sqlsrv是否开启<br/>
![](http://a2.qpic.cn/psb?/V12ol6gx2nrILn/jtmc.z*52s9bLotshNBH3JSKv0YICbmuJzGiwPdiEmE!/b/dB4BAAAAAAAA&bo=zgPEA84DxAMRADc!&rf=viewer_4)

## 二、连接数据库 ##
1. 安装代码编辑器 [Visual Studio Code](https://code.visualstudio.com/ "前往下载")，用以编辑代码<br/>
![](http://a3.qpic.cn/psb?/V12ol6gx2nrILn/QYoRZ22*bNL4qOR5CDkVEUqFU68MIvg9h32ZOcRhC3A!/b/dAEBAAAAAAAA&bo=MQaAAmsH*wIRABM!&rf=viewer_4)
2. 从github上获取项目 [Flow-statistics](https://github.com/leslieeilsel/Flow-statistics)，将项目文件夹放置在**D:\phpStudy\WWW**目录下<br/>
![](http://a2.qpic.cn/psb?/V12ol6gx2nrILn/wUNPZq.PScjzWsN5C8iU5gPFZIloDZNPDnoPcvF0xhU!/b/dPcAAAAAAAAA&bo=BQRjAgUEYwIRADc!&rf=viewer_4)
3. 使用Visual Studio Code打开项目文件夹，**Flow-statistics\logic\php\database.php**，配置数据库连接，完成后保存<br/>
![](http://a1.qpic.cn/psb?/V12ol6gx2nrILn/FmmwhxWYGVC611KZZC0R*Hz6UztexZth7tgn2PAuv88!/b/dHUAAAAAAAAA&bo=bQTLAW0EywERCT4!&rf=viewer_4)
4. 打开浏览器（建议使用Chrome或者Firefox），运行127.0.0.1，点击项目目录即可运行