@extends('layouts.dashboard.app')
<title>{{ __('static.stores.title') }}</title>

@push('css')
@endpush

@section('breadcrumbs')
    @include('dashboard.includes.breadcrumb', [
        'title' => __('static.stores.title'),
        'breadcrumbs' => [
            ['title' => __('static.global.home'), 'url' => route('dashboard.home')],
            ['title' => __('static.stores.title'), 'url' => ''],
        ],
    ])
@endsection

@section('content')
    <!-- DOM - jQuery events table -->
    <section id="language">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a data-toggle="modal" data-target="#add-store" type="button"
                            class="btn btn-info btn-min-width btn-glow mr-1 mb-1">{{ __('static.stores.create_new_store') }}</a>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <p class="card-text">{{ __('dashboard.stores.store_table_paragraph') }}</p>
                            @include('dashboard.includes.toster-error')
                            @include('dashboard.includes.toster-success')
                            <table id="dataTable" class="table table-striped table-bordered language-file">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('static.stores.title') }}</th>
                                        <th>{{ __('static.stores.logo') }}</th>
                                        <th>{{ __('static.status.title') }}</th>
                                        <th>{{ __('static.stores.catalogs_count') }}</th>
                                        <th>{{ __('static.stores.email') }}</th>
                                        <th>{{ __('static.stores.phone') }}</th>
                                        <th>{{ __('static.stores.website_url') }}</th>
                                        <th>{{ __('static.stores.importance_level') }}</th>
                                        <th>{{ __('static.global.created_at') }}</th>
                                        <th>{{ __('static.actions.title') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('static.stores.title') }}</th>
                                        <th>{{ __('static.stores.logo') }}</th>
                                        <th>{{ __('static.status.title') }}</th>
                                        <th>{{ __('static.stores.catalogs_count') }}</th>
                                        <th>{{ __('static.stores.email') }}</th>
                                        <th>{{ __('static.stores.phone') }}</th>
                                        <th>{{ __('static.stores.website_url') }}</th>
                                        <th>{{ __('static.stores.importance_level') }}</th>
                                        <th>{{ __('static.global.created_at') }}</th>
                                        <th>{{ __('static.actions.title') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.stores._create')
    </section>
    <!-- DOM - jQuery events table -->
@endsection

@push('js')
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#add-store').modal('show');
                $('#store-form').parsley();
            });
        </script>
    @endif
    <script>
        pdfMake.fonts = {
            Amiri: {
                normal: "{{ asset('fonts/Amiri/Amiri-Regular.ttf') }}",
                bold: "{{ asset('fonts/Amiri/Amiri-Bold.ttf') }}",
                italics: "{{ asset('fonts/Amiri/Amiri-Italic.ttf') }}",
                bolditalics: "{{ asset('fonts/Amiri/Amiri-BoldItalic.ttf') }}"
            }
        };
        var lang = "{{ app()->getLocale() }}"
        $('#dataTable').DataTable({
            language: lang == 'ar' ? {
                url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/ar.json',
                emptyTable: "لا توجد بيانات متاحة في الجدول",
                zeroRecords: "لم يتم العثور على سجلات",
                info: "عرض _START_ إلى _END_ من _TOTAL_ سجل",
                infoEmpty: "يعرض 0 إلى 0 من 0 سجل",
                infoFiltered: "(تم تصفيته من _MAX_ إجمالي السجلات)"
            } : {
                emptyTable: "No data available in table",
                zeroRecords: "No matching records found",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)"
            },
            responsive: {
                details: {
                    display: DataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            var detailsForText = @json(__('static.global.details_for'));
                            return detailsForText + ' ' + data.name;
                        }
                    }),
                    renderer: DataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            },
            fixedHeader: true,
            colReorder: true,
            select: true,
            processing: true,
            serverSide: true,
            // scroller: true,
            // scrollY: 200,
            ajax: "{{ route('dashboard.stores.all') }}",
            rowId: function(row) {
                return `store_${row.id}`;
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'logo',
                    name: 'logo'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'catalogs_count',
                    name: 'catalogs_count'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'website_url',
                    name: 'website_url'
                },
                {
                    data: 'importance_level',
                    name: 'importance_level'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false
                },
            ],
            dom: 'Bfrtip', // تمكين الأزرار
            buttons: [{
                    extend: 'copyHtml5',
                    text: 'نسخ',
                    exportOptions: {
                        columns: ':visible', // الأعمدة الظاهرة فقط
                        modifier: {
                            page: 'current' // البيانات في الصفحة الحالية فقط
                        }
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'تصدير Excel',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'تصدير PDF',
                    customize: function(doc) {
                        doc.defaultStyle = {
                            font: 'Amiri', // الخط المخصص إذا لزم الأمر
                            alignment: 'right'
                        };
                        doc.styles.tableHeader = {
                            alignment: 'right',
                            font: 'Amiri',
                            bold: true
                        };
                    },
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'print',
                    text: 'طباعة',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'current'
                        }
                    }
                },
                'colvis' // زر إظهار/إخفاء الأعمدة
            ]
        });


        $(document).ready(function() {
            let valueIndex = ($('.branches_row').length) + 1 || 2;
            let store_id = $('#store_id').val();

            $('#add_more_branches').on('click', function(e) {
                e.preventDefault();
                let newRow = `

                    <div class="row branches_row">
                            <div class="col-md-12"><h4>{{ __('static.stores.branch') }} ${valueIndex}</h4></div>
                            <div class="col-md-10" id="address-dropdown-${valueIndex}">
                                <fieldset class="form-group">
                                    <label for="neighborhood_${valueIndex}">{{ __('static.regions.neighborhood_name') }}</label>
                                    <select class="single-select-box selectivity-input" id="neighborhood_${valueIndex}"
                                        data-placeholder="No city selected" name="branches[${valueIndex}][neighborhood_id]">
                                        @foreach ($neighborhoods as $neighborhood)
                                            <option value="{{ $neighborhood->id }}">{{ $neighborhood->name }} -
                                                {{ $neighborhood->postal_code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>

                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="address_${valueIndex}">{{ __('static.stores.address') }}</label>
                                    <input type="text" id="address_${valueIndex}" class="form-control border-primary"
                                        placeholder="{{ __('static.stores.address') }}"
                                       name="branches[${valueIndex}][address]">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="location_${valueIndex}">{{ __('static.stores.location') }}</label>
                                    <input type="text" id="location_${valueIndex}" class="form-control border-primary"
                                        placeholder="{{ __('static.stores.location') }}"
                                        name="branches[${valueIndex}][location]">
                                </div>
                            </div>
                            <div class="col-md-2 mt-2">
                                <button type="button" class="btn btn-danger removeValRow"><i
                                        class="ft-x"></i></button>
                            </div>
                     </div>
                `;

                $('.branches_row:last').after(newRow);
                $(`#neighborhood_${valueIndex}`).selectivity();
                valueIndex++;
            });

            $(document).on('click', '.removeValRow', function() {
                $(this).closest('.branches_row').remove();
            });
        });
    </script>
@endpush
