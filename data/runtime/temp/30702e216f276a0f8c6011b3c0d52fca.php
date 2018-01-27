<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:70:"D:\phpStudy\PHPTutorial\WWW\imf\public/../app/install\view\\step3.html";i:1516390351;s:75:"D:\phpStudy\PHPTutorial\WWW\imf\public/../app/install\view\public\head.html";i:1516388804;s:77:"D:\phpStudy\PHPTutorial\WWW\imf\public/../app/install\view\public\header.html";i:1516389906;s:77:"D:\phpStudy\PHPTutorial\WWW\imf\public/../app/install\view\public\footer.html";i:1516388784;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
<title>PHP ThinkIMF安装</title>
<link rel="stylesheet" href="__STATIC__/install/simpleboot/themes/flat/theme.min.css" />
<link rel="stylesheet" href="__STATIC__/install/css/install.css" />
<link rel="stylesheet" href="__STATIC__/font-awesome/css/font-awesome.min.css" type="text/css">


</head>
<body>
<div class="wrap">
    <div class="header">
    <h1 class="logo"><marquee style="color:red;">PHP ThinkIMF 安装向导</marquee></h1>
	<div class="version"><?php echo THINKCMF_VERSION; ?></div>
</div>
    <section class="section">
        <div class="step">
            <ul class="unstyled">
                <li class="on"><em>1</em>检测环境</li>
                <li class="current"><em>2</em>创建数据</li>
                <li><em>3</em>完成安装</li>
            </ul>
        </div>
        <form id="js-install-form" action="<?php echo url('index/step4'); ?>" method="post">
            <input type="hidden" name="force" value="0"/>
            <div class="server">
                <table width="100%">
                    <tr>
                        <td class="td1" width="100">数据库信息</td>
                        <td class="td1" width="200">&nbsp;</td>
                        <td class="td1">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-left">数据库服务器：</td>
                        <td><input type="text" name="dbhost" id="dbhost" value="127.0.0.1" class="input"></td>
                        <td>
                            <div id="js-install-tip-dbhost">
                                <span class="gray">数据库服务器地址，一般为127.0.0.1或localhost</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left">数据库端口：</td>
                        <td><input type="text" name="dbport" id="dbport" value="3306" class="input"></td>
                        <td>
                            <div id="js-install-tip-dbport">
                                <span class="gray">数据库服务器端口，一般为3306</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left">数据库用户名：</td>
                        <td><input type="text" name="dbuser" id="dbuser" autocomplete="off" value="root" class="input"></td>
                        <td>
                            <div id="js-install-tip-dbuser"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left">数据库密码：</td>
                        <td>
                            <input type="password" name="dbpw" id="dbpw" autocomplete="off" value="" class="input" autoComplete="off"
                                   onblur="TestDbPwd()">
                        </td>
                        <td>
                            <div id="js-install-tip-dbpw"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left">数据库名：</td>
                        <td><input type="text" name="dbname" id="dbname" value="ud" class="input"></td>
                        <td>
                            <div id="js-install-tip-dbname">
                                <span class="gray">最好小写字母</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left">数据库表前缀：</td>
                        <td><input type="text" name="dbprefix" id="dbprefix" value="ud_" class="input"></td>
                        <td>
                            <div id="js-install-tip-dbprefix">
                                <span class="gray">建议使用默认，同一数据库安装多个ThinkIMF时需修改</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left">数据库编码：</td>
                        <td>
                            <select type="text" name="dbcharset" id="dbcharset" value="" class="input">
                                <option value="utf8mb4">utf8mb4</option>
                                <option value="utf8">utf8</option>
                            </select>
                        </td>
                        <td>
                            <div id="js-install-tip-dbcharset">
                                <span class="gray">如果您的服务器是虚拟空间不支持uft8mb4,请选择 utf8</span>
                            </div>
                        </td>
                    </tr>
                </table>
                <table width="100%">
                    <tr>
                        <td class="td1" width="100">网站配置</td>
                        <td class="td1" width="200">&nbsp;</td>
                        <td class="td1">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-left">网站名称：</td>
                        <td><input type="text" name="sitename" value="ThinkIMF 物联网设备以及内容管理框架" class="input"></td>
                        <td>
                            <div id="js-install-tip-sitename"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left">关键词：</td>
                        <td>
                            <input type="text" name="sitekeywords"
                                   value="Web3.0,ThinkIMF,php7,物联网管理框架内容管理框架,imf,cms,framework,ThinkIMF,物联网内容管理系统,ThinkIMF IOT后台管理系统,物联网企业建站系统,php开源软件,内容管理框架,imf,php thinkimf cms,cmf,实用型开源框架,practicality framework" class="input"
                                   autoComplete="off">
                        </td>
                        <td>
                            <div id="js-install-tip-sitekeywords"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left">描述：</td>
                        <td>
                            <input type="text" name="siteinfo" class="input" value="ThinkIMF是全球第一款基于PHP7.x + MYSQL开发的物联网IOT内容管理框架(IMF),我们一直坚持参与PHP开源框架建设，致力于让个人，大学生，智慧社团，企业更好的将物联网做好，致力于加速完成中国梦的新征程。让您更快地完成自己的创业项目！">
                        </td>
                        <td>
                            <div id="js-install-tip-siteinfo"></div>
                        </td>
                    </tr>
                </table>
                <table width="100%">
                    <tr>
                        <td class="td1" width="100">创始人信息</td>
                        <td class="td1" width="200">&nbsp;</td>
                        <td class="td1">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-left">管理员帐号：</td>
                        <td><input type="text" name="manager" value="admin" class="input"></td>
                        <td>
                            <div id="js-install-tip-manager"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left">密码：</td>
                        <td>
                            <input type="password" name="manager_pwd" id="js-manager-pwd" class="input"
                                   autoComplete="off">
                        </td>
                        <td>
                            <div id="js-install-tip-manager_pwd">
                                 <span class="gray">
                                密码长度不低于6位,不高于32位。
                                 </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left">重复密码：</td>
                        <td>
                            <input type="password" name="manager_ckpwd" class="input" autoComplete="off">
                        </td>
                        <td>
                            <div id="js-install-tip-manager_ckpwd"></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left">Email：</td>
                        <td><input type="text" name="manager_email" class="input" value=""></td>
                        <td>
                            <div id="js-install-tip-manager_email"></div>
                        </td>
                    </tr>
                </table>
                <div id="js-response-tips" style="display: none;"></div>
            </div>
            <div class="bottom text-center">
                <a href="<?php echo url('index/step2'); ?>" class="btn btn-primary">上一步</a>
                <button type="submit" class="btn btn-primary">创建数据</button>
            </div>
        </form>
    </section>
    <script src="__STATIC__/js/jquery.js"></script>
    <script src="__STATIC__/js/validate.js"></script>
    <script src="__STATIC__/js/ajaxForm.js"></script>
    <script>
        function TestDbPwd() {
            var dbHost = $('#dbhost').val();
            var dbUser = $('#dbuser').val();
            var dbPwd  = $('#dbpw').val();
            var dbName = $('#dbname').val();
            var dbPort = $('#dbport').val();
            data       = {
                'hostname': dbHost,
                'username': dbUser,
                'password': dbPwd,
                'hostport': dbPort
            };
            var url    = "<?php echo url('index/testDbPwd'); ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                beforeSend: function () {
                },
                success: function (msg) {
                    if (msg) {

                    } else {
                        $('#dbpw').val("");
                        $('#js-install-tip-dbpw').html('<span for="dbname" generated="true" class="tips-error" style="">数据库链接配置失败</span>');
                    }
                },
                complete: function () {
                },
                error: function () {
                    $('#js-install-tip-dbpw').html('<span for="dbname" generated="true" class="tips-error" style="">数据库链接配置失败</span>');
                    $('#dbpw').val("");
                }
            });
        }
        $(function () {
            //聚焦时默认提示
            var focus_tips = {
                dbhost: '数据库服务器地址，一般为localhost',
                dbport: '数据库服务器端口，一般为3306',
                dbuser: '',
                dbpw: '',
                dbname: '',
                dbprefix: '建议使用默认，同一数据库安装多个ThinkIMF时需修改',
                dbcharset: '如果您的服务器是虚拟空间不支持uft8mb4,请选择 utf8',
                manager: '创始人帐号，拥有站点后台所有管理权限',
                manager_pwd: '密码长度不低于6位,不高于32位',
                manager_ckpwd: '',
                sitename: '',
                siteurl: '请以“/”结尾',
                sitekeywords: '',
                siteinfo: '',
                manager_email: ''
            };

            var install_form = $("#js-install-form");

            //validate插件修改了remote ajax验证返回的response处理方式；增加密码强度提示 passwordRank
            install_form.validate({
                //debug : true,
                //onsubmit : false,
                errorPlacement: function (error, element) {
                    //错误提示容器
                    $('#js-install-tip-' + element[0].name).html(error);
                },
                errorElement: 'span',
                //invalidHandler : , 未验证通过 回调
                //ignore : '.ignore' 忽略验证
                //onkeyup : true,
                errorClass: 'tips-error',
                validClass: 'tips-error',
                onkeyup: false,
                focusInvalid: false,
                rules: {
                    dbhost: {required: true},
                    dbport: {required: true},
                    dbuser: {required: true},
                    /* dbpw: {required	: true}, */
                    dbname: {required: true},
                    dbprefix: {required: true},
                    manager: {required: true},
                    manager_pwd: {required: true,minlength:6,maxlength:32},
                    manager_ckpwd: {required: true, equalTo: '#js-manager-pwd'},
                    manager_email: {required: true, email: true}
                },
                highlight: false,
                unhighlight: function (element, errorClass, validClass) {
                    var tip_elem = $('#js-install-tip-' + element.name);
                    tip_elem.html('<span class="' + validClass + '" data-text="text"><span>');
                },
                onfocusin: function (element) {
                    var name = element.name;
                    $('#js-install-tip-' + name).html('<span data-text="text">' + focus_tips[name] + '</span>');
                    $(element).parents('tr').addClass('current');
                },
                onfocusout: function (element) {
                    var _this = this;
                    $(element).parents('tr').removeClass('current');

                    if (element.name === 'email') {
                        //邮箱匹配点击后，延时处理
                        setTimeout(function () {
                            _this.element(element);
                        }, 150);
                    } else {
                        _this.element(element);
                    }

                },
                messages: {
                    dbhost: {required: '数据库服务器地址不能为空'},
                    dbport: {required: '数据库服务器端口不能为空'},
                    dbuser: {required: '数据库用户名不能为空'},
                    dbpw: {required: '数据库密码不能为空'},
                    dbname: {required: '数据库名不能为空'},
                    dbprefix: {required: '数据库表前缀不能为空'},
                    manager: {required: '管理员帐号不能为空'},
                    manager_pwd: {required: '密码不能为空',minlength:'密码长度不低于{0}位',maxlength:'密码长度不超过{0}位'},
                    manager_ckpwd: {required: '重复密码不能为空', equalTo: '两次输入的密码不一致,请重新输入.'},
                    manager_email: {required: 'Email不能为空', email: '请输入正确的电子邮箱地址'}
                },
                submitHandler: function (form) {
                    form.submit();
                    return true;
                }
            });
        });
    </script>
</div>
<div class="footer">
	&copy; 2014-<?php echo date('Y'); ?> <a href="https://www.thinkimf.com" target="_blank">Thinkimf Team</a>
</div>
</body>
</html>