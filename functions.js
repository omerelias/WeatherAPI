$(function () {
    $("#dboutput").hide();
    $("#apioutput").hide();

    $('#getfromapi').on('click', function () {
        $("#dboutput").hide();
        $("#apioutput").show();
        
            var vars = {
             name: $('#name').val(),
            }
            $.ajax({
                url: "http://api.openweathermap.org/data/2.5/forecast?q=" + vars.name + "&lang=en&units=metric&APPID=a1054113914944e3728eba16e5a2afbc"
                , data: vars
                , type: "POST"
                , dataType: 'json'
            }).done(function (d) {
                var exam=d.list[0];
                var resultsfromapi="";
                for(var x=0; x<d.list.length;x++){
                resultsfromapi+="<tr>";
                resultsfromapi+="<td>"+d.list[x].dt_txt+"</td>";
                resultsfromapi+="<td>"+d.list[x].main.temp_min+"</td>";
                resultsfromapi+="<td>"+d.list[x].main.temp_max+"</td>";
                resultsfromapi+="<td>"+d.list[x].wind.speed+"</td>";
                resultsfromapi+="</tr>";
                }
                $('#apicityname').html($('#name').val());
                $('#resultsfromapi').html(resultsfromapi);
            });
            
        });

        $("#savetodb").on('click',function(){
            var vars = {
                name: $('#name').val()
               }
               $.ajax({
                   url: "http://api.openweathermap.org/data/2.5/forecast?q=" + vars.name + "&lang=en&units=metric&APPID=a1054113914944e3728eba16e5a2afbc"
                   , data: vars
                   , type: "POST"
                   , dataType: 'json'
               }).done(function (d){
                var details={
                    name:$('#name').val(),
                    datetime:d.list[0].dt_txt,
                    mintemp:d.list[0].main.temp_min,
                    maxtemp:d.list[0].main.temp_max,
                    windspeed:d.list[0].wind.speed,
                    action: 'ADD'
                }
                $.ajax({
                    url:"api.php"
                    ,data:details
                    ,dataType:'json'
                    ,type:"POST"
                }).done(function (data) {
                    alert(data.message);
                });
               });
        })


        // SECOND BUTTON
        $('#getfromdb').on('click', function () {
            $("#apioutput").hide();
            $("#dboutput").show();
            var vars = {
                name: $("#name").val()
                ,action: 'GET'
            }
            $.ajax({
                url: "api.php"
                , data: vars
                , type: 'POST'
                , dataType: 'json'
            }).done(function (data) {
                var data=data.response[0];
                var resultsfromdb="<tr>";
                resultsfromdb+="<td>"+data.t_date_time+"</td>";
                resultsfromdb+="<td>"+data.t_temp_min+"</td>";
                resultsfromdb+="<td>"+data.t_temp_min+"</td>";
                resultsfromdb+="<td>"+data.w_speed+"</td>";
                resultsfromdb+="</tr>";
                $('#resultsfromdb').html(resultsfromdb);
            }).fail(function (xhr, textstatus) {
                console.log(xhr);
              })
        })
    });

