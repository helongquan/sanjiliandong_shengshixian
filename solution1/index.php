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
        margin: 20px auto;
        border: 1px dashed black;
        }
    h2{
        text-align: center;
    }
span{font-size:20px;width: 66px;height: 30px;margin-left: 20px;display: inline-block;}
select{width: 100px;height: 30px;font-size:16px;}
.sub{margin-left: 200px;margin-top: 5px;  width: 70px;height: 30px;font-size:20px; line-height: 20px; background-color: rgb(49, 159, 229);color: white;border-radius: 3px;border: none;}
</style>
    <script src="jquery-3.3.1.min.js"></script>
</head>

<body>
    <div class='box'><h2>nocti</h2>
        <form id="pcc" action="action.php" method="POST">
            <span>省:</span>
            <select id="pro" name="pro"> </select>
            <span>市:</span>
            <select id="city" name="city"></select>
            <span>县/区:</span>
            <select id="county" name="county"> </select>
            <input class="sub" type="submit" value="提交">
        </form>
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
                var option = '<option>--请选择--</option>';
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
                    $("#city option").remove();
                    $("#county option").remove();
                    var option = '<option>--请选择--</option>';
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
                    $("#county option").remove();
                    var option = '<option>--请选择--</option>';
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