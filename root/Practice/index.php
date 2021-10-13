<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script>
        function fun() {
            $('form').bind('submit', function() {
                $.ajax({
                    type: 'post',
                    url: 'insertion.php',
//                    data: $('form').serialize(),
                    data: {name: "asad", fname: "tariq"},
                    success: function(data) {
                        alert('form was submitted');
                        console.log(data);
                    }
                });
                return false;
            });
        }
    </script>

</head>

<body>

    <form>
        <input type="text" name="empName" id="empNameID"><br>
        <input type="password" name="password" id="empPassID"><br>
        <button type="submit" value="submit" name="submit" onclick="fun()"> Submit </button>

    </form>

    <script src="../JS/jQuery/jquery-3.6.0.js"></script>
</body>

</html>