<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Fonts -->
        <!--<link rel="stylesheet" href="{{ url('quickadmin/css') }}/bootstrap.min.css"/>   -->      
        <!-- Styles -->
        <!--  <script src='{!! url('js/bootstrap.min.js') !!}' type='text/javascript'></script>--> 
        <!--<script src='{!! url('js/jquery-3.1.1.min.js') !!}' type='text/javascript'></script>--> 

        <style type="text/css"> 
            body {
                font-family: Tahoma;
                margin: 0;
                padding: 0;
                text-align: center;
            }
            a {
                text-decoration: none;
                color: darkblue;
            }
            a:hover {
                text-decoration: underline;
            }
            img {
                width: 175px;
                height: 250px;
                border: 2px solid #aaa;
            }
            #header {
                background-color: #8C1B08;
                color: #fff;
                padding: 5px;
            }
            #header a{
                color: #fff;
                text-decoration: none;
            }
            #main table {
                margin: 0 auto;
            }
            #footer {
                font: 12px Tahoma;
                margin: 25px 0 50px 0;
            }
            #footer a {
                margin-right: 10px;
            }
        </style>
        
    </head>
    <body>
        <div id="header">
            <h1><a href="index.html">FACEMASH</a></h1>
        </div>
        <div id="main">
            <h3>Were we let in for our looks? No. Will we be judged on them? Yes.</h3>
            <h2>Who's Hotter? Click to Choose.</h2>
            <table>
                <tr class = "row-image">
                   
                    <td>
                        <a id="left" onclick="getRandom('<?php echo $staff[0]['id']  ?>','<?php echo 'left'?>');"><img   id="imgLeft" src="{{ asset('uploads/') . '/'.  $staff[0]['image'] }}"></a>
                        
                    </td>
                    <td>OR</td>
                    <td class="right">
                       <a id="right" onclick="getRandom('<?php echo $staff[1]['id']  ?>','<?php echo 'right'?>');"> <img id="imgRight" src="{{ asset('uploads/') . '/'.  $staff[1]['image'] }}">
                       </a>
                    </td>
                </tr>
            </table>
        </div>
        
        <script type="text/javascript"> 

            function getRandom(id,choose){                                              
                $.ajax({
                    type:'GET',
                    url:'jp/get-random',
                    dataType: 'json',
                    data:'func=getRandom&id='+id+'&choose='+choose,

                    success:function(staffs){                        
                        $("#left").attr("onclick","getRandom('"+staffs[0]['id']+"','left')");

                        $("#imgLeft").attr("src","http://localhost/facemash/public/uploads/"+staffs[0]['image']);

                        $("#right").attr("onclick","getRandom('"+staffs[1]['id']+"','right')");

                        $("#imgRight").attr("src","http://localhost/facemash/public/uploads/"+staffs[1]['image']);                        
                    }
                });
            }

            $(document).ready(function(){
                var dateOld = new Date();
                var timeOld = dateOld.getTime();
                $(window).on('beforeunload', function(){

                    var dateNew = new Date();
                    var timeNew = dateNew.getTime();                    
                    var time = timeNew - timeOld;
                    time = time * 1.66666667 * Math.pow(10,-5);
                    time = time.toFixed(2);

                    $.ajax({
                    type:'GET',
                    url:'jp/get-time',
                    dataType: 'json',
                    data:'time='+time
                    });
                });

            });
                         


            
        </script>        
    </body>
</html>
