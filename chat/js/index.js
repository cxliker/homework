/**
 * Created by Daniel on 2017/3/29.
 */
$(function () {
    $("#contentBox button").click(function () {
        var content = $("#contentBox textarea").val();
        var name = $("#contentBox input[name='nickname']").val();
        if (name.length == 0 || content.length == 0) {
            $(".error").html("*内容和昵称都不能为空*");
        } else {
            $(".error").html("");
            $.post("handler.php", {
                type: "summit",
                name: name,
                content: content
            });
        }
    });

    var id = "2016-03-29 14:05:03";
    function get() {
        $.getJSON("handler.php", {
            type: "get",
            id: id
        }, function (data) {
            // $("#history").html("");
            for (var i = 0 ; i < data.length ; i++) {
                $("#history").append("<h5>" + data[i].name + "(" + data[i].time + ")</h5>");
                $("#history").append("<h5>" + data[i].content + "</h5>");
            }
            id = data[--i].time;
        })
    }
    get();
    setInterval(function () {
        get();
    }, 3000);
});
