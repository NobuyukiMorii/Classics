function SpeedTest(){
    var start = (new Date()).getTime();
    $.get('/Classics/img/heavy.jpg?' + start, function(data) {
        var end = (new Date()).getTime();
        var sec = (end - start) / 1000;
        var mbps =  (( (data.length *8) / sec)/1000000).toFixed(2);
        $('#wifi_speed').val(mbps);
        $('#wifi_speed_text').text(mbps);
    });
};