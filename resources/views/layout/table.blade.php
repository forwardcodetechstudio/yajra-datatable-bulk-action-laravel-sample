@extends('layout.app')

@section('title')
    {{ $title }}
@endsection


@push('extra_css')
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary) !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--primary);
            color: white !important;
            opacity: 0.8;
        }

        input.js-delete-switch {
            transform: scale(2);
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.2.2/css/fixedColumns.dataTables.min.css">

    @if (isset($css_list) && !empty($css_list))
        @foreach ($css_list as $css)
            <link type="text/css" rel="stylesheet" href="{{ $css }}" />
        @endforeach
    @endif

@endpush


@section('content')
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="table-responsive">
                    {!! $dataTable->table(['class' => 'display table table-bordered dataTable dtr-inline collapsed']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('extra_scripts')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.2/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.2/vfs_fonts.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script src="{{ asset('backend/vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.2.2/js/dataTables.fixedColumns.min.js"></script>
    {!! $dataTable->scripts() !!}

    @if (isset($scripts) && !empty($scripts))
        @foreach ($scripts as $script)
            <script src="{{ $script }}"></script>
        @endforeach
    @endif

    @if (isset($extra_components) && !empty($extra_components))
        @foreach ($extra_components as $component)
            {!! $component !!}
        @endforeach
    @endif

    <script>
        /*
        --------------------------------------
            : Custom - jQuery Confirm js :
        --------------------------------------
        */

        var selected_rows = [];
        var action_url = '';
        var action_method = '';
        var action_confirm_message = '';
        var action_confirm_button_label = '';

        function initSingleCheckboxes() {
            $('.child-switches').click(function(e) {

                if ($(this).is(':checked', true)) {
                    if (selected_rows.includes($(this).data('model-id')) == false) {
                        selected_rows.push($(this).data('model-id'));
                    }
                } else {
                    var element_index = selected_rows.indexOf($(this).data('model-id'))
                    selected_rows.splice(element_index, 1);
                }
                console.log(selected_rows);
                $("#selected_rows").val(selected_rows);
            });

        };

        function initDeleteAllCheckbox() {
            $('#delete-all-records').click(function(e) {
                if ($(this).is(':checked', true)) {
                    $('input.child-switches').each(function(index) {
                        var switchStatus = $('input.child-switches')[index].checked;
                        if (switchStatus == false) {
                            $(this).trigger('click');
                        }
                    });
                } else {
                    $('input.child-switches').each(function(index) {
                        var switchStatus = $('input.child-switches')[index].checked;
                        if (switchStatus == true) {
                            $(this).trigger('click');
                        }
                    });
                }
            });
        }

        function deleteData(current) {

            $.confirm({
                title: 'Confirm',
                content: 'Are you sure to delete!',
                buttons: {
                    delete: {
                        text: 'Delete',
                        btnClass: 'btn-danger',
                        keys: ['enter', 'shift'],
                        action: function() {
                            $.ajax({
                                method: "DELETE",
                                url: $(current).data('url'),
                                success: function(response) {
                                    var oTable = $('.dataTable').dataTable();
                                    oTable.fnDraw(false);
                                    selected_rows = [];
                                    $("#selected_rows").val(selected_rows);
                                    toastr.success(response.message, response.title);
                                },
                                error: function(response) {
                                    console.log(response.responseText);
                                }
                            });
                            $(current).parent().submit();
                        },
                    },
                    cancel: {
                        text: 'Cancel',
                        btnClass: 'btn-primary',
                        keys: ['enter', 'shift'],
                        action: function() {},
                    },
                }
            });

        }

        function fetchDataAndReloadDataTable() {

            let selectedRows = $("#selected_rows").val();
            $('.dataTable')
                .on('preXhr.dt', function(e, settings, data) {
                    data['selected_rows'] = selectedRows;
                });
            var oTable = $('.dataTable').dataTable();
            oTable.fnDraw(false);
        }

        $('#filter').click(function(e) {
            fetchDataAndReloadDataTable();
            selected_rows = [];
            $("#selected_rows").val("");
        });

        $('#reset').click(function(e) {
            selected_rows = [];
            $("#selected_rows").val("");
            fetchDataAndReloadDataTable();
        });

        function initActionJs() {

            $("#bulk_actions").change(function(e) {
                if ($(this).val() == 'status') {
                    $("#status-wrapper").show();
                    $("#status").attr("required", true);
                } else {
                    $("#status-wrapper").hide();
                    $("#status").removeAttr("required");
                }
                action_url = $(this).find('option:selected').attr('data-url');
                action_method = $(this).find('option:selected').attr('data-method');
                action_confirm_message = $(this).find('option:selected').attr('data-confirm-message');
                action_confirm_button_label = $(this).find('option:selected').attr('data-confirm-button-label');
            });

            $("#action_form").submit(function(e) {
                e.preventDefault();
                var selected_ids = [];

                formData = {
                    ids: $("#selected_rows").val(),
                    status: $("#status").val(),
                };

                $(".child-switches:checked").each(function() {
                    selected_ids.push($(this).data('model-id'));
                });

                if (selected_ids.length <= 0) {
                    $.alert({
                        title: 'Alert!',
                        content: 'Please select any record!',
                    });
                } else {
                    $.confirm({
                        title: 'Confirm',
                        content: action_confirm_message,
                        buttons: {
                            delete: {
                                text: action_confirm_button_label,
                                btnClass: 'btn-danger',
                                keys: ['enter', 'shift'],
                                action: function() {
                                    ajaxCallback(formData);
                                },
                            },
                            cancel: {
                                text: 'Cancel',
                                btnClass: 'btn-primary',
                                keys: ['enter', 'shift'],
                                action: function() {},
                            },
                        }
                    });
                }
            });

            function ajaxCallback(formData) {
                button_spinner('#apply_btn', 'Applying...', true);
                $.ajax({
                    method: action_method,
                    url: action_url,
                    dataType: 'json',
                    data: formData,
                    success: function(response) {
                        button_restore('#apply_btn', 'Apply', false);
                        var oTable = $('.dataTable').dataTable();
                        oTable.fnDraw(false);
                        selected_rows = [];
                        $("#selected_rows").val(selected_rows);
                        toastr.success(response.message, response.title);
                    },
                    error: function(response) {
                        button_restore('#apply_btn', 'Apply', false);
                        console.log(response.responseText);
                    }
                });
            }
        }
    </script>
@endpush


@push('extra_components')

    @if (isset($extras) && !empty($extras))
        @foreach ($extras as $component)
            {!! $component !!}
        @endforeach
    @endif
@endpush
