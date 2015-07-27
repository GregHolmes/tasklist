$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    setInterval( function() {
        taskRetrieval();
    },1000);
});
var currentminute;

$(document).delegate(".add-btn", "click", function() {
    var task = $('#task').val();
    var inputDate = $('#inputDate').val();
    addTask(task, inputDate);
});

$(document).delegate(".glyphicon", "click", function() {
    if ($(this).hasClass("glyphicon-save")) {
        var id = $(this).parent().attr("id");
        closeTask(id);
        currentminute='';
    }
});

function closeTask(id) {
    return $.ajax({
       url: 'http://localhost/tasks/public/closeTask/'+id,
        type: 'get',
        data: "",
        dataType: 'json',
        "_token": "{{ csrf_token() }}",
        success: function() {
            currentminute='';
        }
    });
}

function getTasks() {
    return $.ajax({
        url: 'http://localhost/tasks/public/getTasks',
        type: 'get',
        data: "",
        dataType: 'json',
        "_token": "{{ csrf_token() }}",
        success: function () {
        }
    });
}

function addTask(task, inputDate) {
    $.ajax({
        url: 'http://localhost/tasks/public/addTask',
        type: "post",
        data: {'task': task, 'inputDate': inputDate},
        success: function (data) {
            currentminute='';
        }
    });
}

function taskRetrieval() {
    // Creating new Date objects to extract seconds, minutes and hours based on server/users computer
    var date = new Date();
    var datetime = addZero(date.getFullYear())+"-"+
            addZero(date.getMonth()+1)+"-"+
            addZero(date.getDate())+" "+
            addZero(date.getHours())+":"+
            addZero(date.getMinutes()
    );
    var tasks = '';

    $("#sec").html(addZero(date.getSeconds()));
    $("#min").html(addZero(date.getMinutes()));
    $("#hours").html(addZero(date.getHours()));

    if(currentminute != date.getMinutes()) {
        getTasks().success(function (data){
            tasks='<li class="list-group-item active">Task List</li>';
            $.each(data, function (key, value) {
                var cssClass = '';
                if(checkExpiring(value.expiry, datetime))
                {
                    var highlight = 'highlight';
                }

                tasks += '<li class="list-group-item '+highlight+'" id="'+ value.id +'">' + value.task + '<span class="glyphicon pull-right glyphicon-save"></span> </li>';
            });
            if(data.length === 0)
            {
                tasks += '<li class="list-group-item">There are no tasks active</li>';
            }
            $('.list-group').html(tasks);

        });
    }
    currentminute = date.getMinutes();
}

function checkExpiring(expiry, datetime) {

    var split = expiry.split(" ");
    var datesplit = split[0].split("-");
    var timesplit = split[1].split(":");

    var toExisting = datesplit[0]+'-'+datesplit[1]+'-'+datesplit[2]+' '+timesplit[0]+':'+timesplit[1];

    if(datetime == toExisting)
    {
        return true;
    }
}

function addZero(num) {
    return (num >= 0 && num < 10) ? "0" + num : num + "";
}