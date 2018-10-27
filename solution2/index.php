<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>省市县</title>
    <style>
    .box{
        margin-left: 20px;
        margin-top: 20px;
        max-width: 600px;
        display: block;
        width: 100%;
        padding: 20px;
        margin: 20px auto;
        border: 1px dashed black;
        border-radius: 5px;
        }
    h2{
        text-align: center;
    }
    span{
        font-size:20px;height: 30px;margin-left: 20px;display: inline-block;
    }
    select{
        width: 100px;
        height: 30px;
        font-size: 16px;
    }
    .sub{
        background-color: rgb(49, 159, 229);
        color: white;
        border-radius: 3px;
        border: none;
        padding: 5px 20px;
        display: block;
        text-align: center;
        margin: 25px auto;
        text-decoration: none;
    }
    .mmeg{
        text-align: center;
        margin: 30px auto;
        display: block;
    }
    </style>
    <script src="jquery-3.3.1.min.js"></script>
</head>

<body>
    <div class='box'><h2>nocti客户需求案例</h2>
        <form id="pcc" action="#" method="POST">
            <div class="mmeg">
                <span>省份:</span>
                <select id="pro" name="pro"> </select>
                <span>市:</span>
                <select id="city" name="city"></select>
                <span>县/区:</span>
                <select id="county" name="county"> </select>
            </div>
            <input class="sub" type="submit" value="查询">
        </form>
        <hr>

        <?php
            if (isset($_POST['county']) && isset($_POST['city']) && isset($_POST['pro'])) {

                

                header("Content-type: text/html; charset=utf-8");
                // 关闭错误报告提示
                error_reporting(0);
                require("mysqldb.php");
                $mydb=new MysqliDB();

                if (!isset($_POST['pro'])) {
                    $sql="select * from cn_area where id IN(".$_POST['city'].",".$_POST['county'].");";
                }else if (!isset($_POST['city'])) {
                    $sql="select * from cn_area where id IN(".$_POST['pro'].",".$_POST['county'].");";
                }else if (!isset($_POST['county'])) {
                    $sql="select * from cn_area where id IN(".$_POST['pro'].",".$_POST['city'].");";
                }else if(!isset($_POST['city']) && !isset($_POST['county'])){
                    $sql="select * from cn_area where id IN(".$_POST['pro'].");";
                }else{
                    $sql="select * from cn_area where id IN(".$_POST['pro'].",".$_POST['city'].",".$_POST['county'].");"; 
                }
                // $sql="select * from cn_area where id IN(".$_POST['city'].");";
                // $sql="select * from cn_area where parentid='0'";
                $datas=$mydb->select($sql);
                // print_r($datas);
                // exit; 
                $addr="";
                foreach( $datas as $v){
                    $addr .= $v['areaname'];
                    // $addr .= $v['url'];
                }
                echo "您选则的地址为：".$addr."<br/>";
                echo "官网地址：".$v['url']."<br/>";
                echo "联系方式：".$v['telephone']."<br/>";
                echo "详细信息：<img src=".$v['detail']." style='width:100%'><br/>";
                echo "<a href='#' class='sub' onclick='window.history.back();'>点击返回</a>";
            }
        ?>

    </div>
    <script>
    $(function() {
        $.ajax({
            type: "POST",
            cache: false,
            url: "pcc.php",
            data: { "pid": 0 },
            dataType: "json",
            success: function(data) {
                var option = '<option>--请选择区域--</option>';
                // console.log(data);
                $.each(data, function(i, n) {
                    option += '<option value="' + n.id + '">' + n.areaname + '</option>';
                })
                $("#pro").append(option);
            }
        });

        $("#pro").change(function() {
            var pid = $(this).val();
            $.ajax({
                type: "POST",
                cache: false,
                url: "pcc.php",
                data: { "pid": pid },
                dataType: "json",
                success: function(data) {
                    //追加本机option前，先清除city和county的option，以免重选时干扰
                    // console.log(data);
                    $("#city option").remove();
                    $("#county option").remove();
                    var option = '<option>--请选择市--</option>';
                    $.each(data, function(i, n) {
                        option += '<option value="' + n.id + '">' + n.areaname + '</option>';
                    })
                    $("#city").append(option);
                }
            });
        });

        $("#city").change(function() {
            var pid = $(this).val();
            $.ajax({
                type: "POST",
                cache: false,
                url: "pcc.php",
                data: { "pid": pid },
                dataType: "json",
                success: function(data) {
                    //同上
                    // console.log(data);
                    $("#county option").remove();
                    var option = '<option>--请选择县区--</option>';
                    $.each(data, function(i, n) {
                        option += '<option value="' + n.id + '">' + n.areaname + '</option>';
                    })
                    $("#county").append(option);
                }
            });
        });
    })
    </script>
</body>

</html>