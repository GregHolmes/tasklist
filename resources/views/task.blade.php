<!DOCTYPE html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        {!! Html::style('css/style.css') !!}
        {!! Html::script('javascript/tasks.js') !!}

        {!! Html::script('bower_components/moment/min/moment.min.js') !!}
        {!! Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') !!}
        {!! Html::script('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}
        {!! Html::style('bower_components/bootstrap/dist/css/bootstrap.min.css') !!}
        {!! Html::style('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') !!}
    </head>
    <body>
        <div class="content">
            <div class="clock">
                <div id="hours"></div>:<div id="min"></div>:<div id="sec"></div>
            </div>

            <div id="form">
                {!! Form::open(array('method'=>'POST', 'id'=>'myform')) !!}
                {!! Form::text('task','',array('class' => 'form-control', 'id'=>'task', 'placeholder'=>'Please add your task here.')) !!}
                <!-- I apologise for the messy switch from blade template to include a datetimepicker! -->
                <div class='input-group' id='datetimepicker1'>
                    <input type='text' id="inputDate" class="form-control" placeholder="When will your task expire?" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                {!! Form::hidden('_token', "{{ csrf_token() }}") !!}
                {!! Form::button('Add Task', array('class'=>'add-btn btn btn-primary')) !!}
                {!! Form::close() !!}
            </div>

            <div class="col-md-4 tasklist">
                <div class="list-group">
                </div>
            </div>

            <div class="container">
                <div class="row">

                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker1').datetimepicker();
                        });
                    </script>
                </div>
            </div>
        </div>
    </body>
</html>
