<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hello</h1>
</body>
<script src="/js/jquery.js"></script>
<script>
    $(document).ready(function () {
        $.ajax({
            type:'GET',
            url:'/test1',
            success: function (response) {
                console.log(response)
            },
            error:function(response){
                console.log(response)
            }
        });
    });
</script>
</html>