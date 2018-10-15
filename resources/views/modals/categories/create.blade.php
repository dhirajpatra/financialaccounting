<div class="modal fade" id="modal-create-category" style="display: none;">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('general.title.new', ['type' => trans_choice('general.categories', 1)]) }}</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['id' => 'form-create-category', 'role' => 'form']) !!}
                <div class="row">
                    {{ Form::textGroup('name', trans('general.name'), 'id-card-o') }}

                    @stack('color_input_start')
                    <div class="form-group col-md-6 required {{ $errors->has('color') ? 'has-error' : ''}}">
                        {!! Form::label('color', trans('general.color'), ['class' => 'control-label']) !!}
                        <div  id="category-color-picker" class="input-group colorpicker-component">
                            <div class="input-group-addon"><i></i></div>
                            {!! Form::text('color', '#00a65a', ['id' => 'color', 'class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                        {!! $errors->first('color', '<p class="help-block">:message</p>') !!}
                    </div>
                    @stack('color_input_end')

                    {!! Form::hidden('type', $type, []) !!}
                    {!! Form::hidden('enabled', '1', []) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    {!! Form::button('<span class="fa fa-save"></span> &nbsp;' . trans('general.save'), ['type' => 'button', 'id' =>'button-create-category', 'class' => 'btn btn-success']) !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-times-circle"></span> &nbsp;{{ trans('general.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#modal-create-category').modal('show');

        $('#category-color-picker').colorpicker();
    });

    $(document).on('click', '#button-create-category', function (e) {
        $('#modal-create-category .modal-header').before('<span id="span-loading" style="position: absolute; height: 100%; width: 100%; z-index: 99; background: #6da252; opacity: 0.4;"><i class="fa fa-spinner fa-spin" style="font-size: 10em !important;margin-left: 35%;margin-top: 8%;"></i></span>');

        $.ajax({
            url: '{{ url("modals/categories") }}',
            type: 'POST',
            dataType: 'JSON',
            data: $("#form-create-category").serialize(),
            beforeSend: function () {
                $(".form-group").removeClass("has-error");
                $(".help-block").remove();
            },
            success: function(json) {
                var data = json['data'];

                $('#span-loading').remove();

                $('#modal-create-category').modal('hide');

                $("#category_id").append('<option value="' + data.id + '" selected="selected">' + data.name + '</option>');
                $("#category_id").select2('refresh');
            },
            error: function(error, textStatus, errorThrown) {
                $('#span-loading').remove();

                if (error.responseJSON.name) {
                    $("#modal-create-category input[name='name']").parent().parent().addClass('has-error');
                    $("#modal-create-category input[name='name']").parent().after('<p class="help-block">' + error.responseJSON.name + '</p>');
                }

                if (error.responseJSON.color) {
                    $("#modal-create-category input[name='color']").parent().parent().addClass('has-error');
                    $("#modal-create-category input[name='color']").parent().after('<p class="help-block">' + error.responseJSON.color + '</p>');
                }
            }
        });
    });
</script>