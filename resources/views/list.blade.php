<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ToDo list project</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <h2 align="center">SIMPLE TODO LISTS</h2>
    <h4 align="center">FROM RUBY GARAGE</h4>

</head>
<body>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-offset-3 col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Complete the test task for Ruby Garage<a href="#" id="addNew" class="pull-right"
                                                               data-toggle="modal" data-target="#myModal"><i
                                    class="fa fa-plus"></i></a></h4>
                </div>
                <div class="panel-body" id="tasks">
                    <ul class="list-group">
                        @foreach($tasks as $task)
                            <li class="list-group-task ourTask" data-toggle="modal"
                                data-target="#myModal">{{$task->task}}
                                <input type="hidden" id="taskId" value="{{$task->id}}"></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="title">Add New Title</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id">
                        <p><input type="text" placeholder="Write task Here" id="addTask" class="form-control"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" id="delete" data-dismiss="modal"
                                style="display: none">Delete
                        </button>
                        <button type="button" class="btn btn-primary" id="saveChanges" data-dismiss="modal" style="display: none">Save
                            changes
                        </button>
                        <button type="button" class="btn btn-primary" id="AddButton" data-dismiss="modal">Add task
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

{{csrf_field()}}
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.ourTask', function (event) {
            var text = $(this).text();
            let id = $(this).find('#taskId').val();
            $('#title').text('Edit task');
            var text = $.trim(text);
            $('#addTask').val(text);
            $('#delete').show('400');
            $('#saveChanges').show('400');
            $('#AddButton').hide('400');
            $('#id').val(id);
            console.log(text);
        });
        $(document).on('click', '#addNew', function (event) {
            $('#title').text('Add New task');
            $('#addTask').val("");
            $('#delete').hide('400');
            $('#saveChanges').hide('400');
            $('#AddButton').show('400');
        });

        $('#AddButton').click(function (event) {
            let text = $('#addTask').val();
            if(text == "") {
                alert('Please type anything for task');
            } else {
                $.post('list', {'text': text, '_token': $('input[name=_token]').val()}, function (data) {
                    console.log(data);
                    $('#tasks').load(location.href + ' #tasks');
                });
            }
        });
        $('#delete').click(function (event) {
            let id = $("#id").val();
            $.post('delete', {'id': id, '_token': $('input[name=_token]').val()}, function (data) {
                $('#tasks').load(location.href + ' #tasks');
                console.log(data);
            });
        });
        $('#saveChanges').click(function (event) {
            let id = $("#id").val();
            let value = $.trim($("#addTask").val());
            $.post('update', {'id': id, 'value': value,'_token': $('input[name=_token]').val()}, function (data) {
                $('#tasks').load(location.href + ' #tasks');
                console.log(data);
            });
        });
    });
</script>
</body>
</html>