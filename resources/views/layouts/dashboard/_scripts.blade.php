 <!-- BEGIN VENDOR JS-->
 <script src="{{ asset('assets/dashboard') }}/vendors/js/vendors.min.js" type="text/javascript"></script>
 <!-- BEGIN VENDOR JS-->
 <!-- BEGIN PAGE VENDOR JS-->
 <script src="{{ asset('assets/dashboard') }}/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
 <script src="{{ asset('assets/dashboard') }}/vendors/js/charts/chartist-plugin-tooltip.min.js" type="text/javascript">
 </script>
 <script src="{{ asset('assets/dashboard') }}/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
 <script src="{{ asset('assets/dashboard') }}/vendors/js/charts/morris.min.js" type="text/javascript"></script>
 <script src="{{ asset('assets/dashboard') }}/vendors/js/timeline/horizontal-timeline.js" type="text/javascript">
 </script>
 <!-- END PAGE VENDOR JS-->
 <!-- BEGIN MODERN JS-->
 <script src="{{ asset('assets/dashboard') }}/js/core/app-menu.js" type="text/javascript"></script>
 <script src="{{ asset('assets/dashboard') }}/js/core/app.js" type="text/javascript"></script>
 <script src="{{ asset('assets/dashboard') }}/js/scripts/customizer.js" type="text/javascript"></script>
 <!-- END MODERN JS-->
 <!-- BEGIN PAGE LEVEL JS-->
 <script src="{{ asset('assets/dashboard') }}/js/scripts/pages/dashboard-ecommerce.js" type="text/javascript"></script>
 <!-- END PAGE LEVEL JS-->

 <script src="{{ asset('assets/js/scripts.js') }}"></script>
 <script src="{{ asset('assets/dashboard') }}/vendors/js/forms/select/selectivity-full.min.js" type="text/javascript">
 </script>
 <script src="{{ asset('assets/dashboard') }}/js/scripts/forms/select/form-selectivity.js" type="text/javascript">
 </script>

 {{-- DataTables --}}
 <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js" type="text/javascript"></script>
 <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>
 <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.min.js" type="text/javascript"></script>
 <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap5.min.js" type="text/javascript"></script>
 <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.colVis.min.js" type="text/javascript"></script>
 <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js" type="text/javascript"></script>
 <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js" type="text/javascript"></script>
 <script src="{{ asset('vendor/datatables/excel/jszip.min.js') }}" type="text/javascript"></script>
 <script src="{{ asset('vendor/datatables/pdf/pdfmake.min.js') }}" type="text/javascript"></script>
 <script src="{{ asset('vendor/datatables/pdf/vfs_fonts.js') }}" type="text/javascript"></script>
 <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js" type="text/javascript">
 </script>
 <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.min.js" type="text/javascript">
 </script>
 <script src="https://cdn.datatables.net/colreorder/2.0.4/js/dataTables.colReorder.min.js" type="text/javascript">
 </script>
 <script src="https://cdn.datatables.net/colreorder/2.0.4/js/colReorder.bootstrap5.min.js" type="text/javascript">
 </script>
 <script src="https://cdn.datatables.net/select/3.0.0/js/dataTables.select.min.js" type="text/javascript"></script>
 <script src="https://cdn.datatables.net/select/3.0.0/js/select.bootstrap5.min.js" type="text/javascript"></script>
 <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.min.js" type="text/javascript">
 </script>
 <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/fixedHeader.bootstrap5.min.js" type="text/javascript">
 </script>
 <script src="https://cdn.datatables.net/scroller/2.4.3/js/dataTables.scroller.min.js" type="text/javascript"></script>
 <script src="https://cdn.datatables.net/scroller/2.4.3/js/scroller.bootstrap5.min.js" type="text/javascript"></script>

 {{-- file input  --}}
 <script src="{{ asset('vendor/fileinput/js/fileinput.min.js') }}"></script>
 <script src="{{ asset('vendor/fileinput/themes/fa5/theme.min.js') }}"></script>
 @if (config('app.locale') == 'ar')
     <script src="{{ asset('vendor/fileinput/js/locales/LANG.js') }}"></script>
     <script src="{{ asset('vendor/fileinput/js/locales/ar.js') }}"></script>
 @endif

 {{-- summernote --}}
 <script src="{{ asset('vendor/summernote/summernote-bs4.min.js') }}"></script>

 <script>
     var lang = "{{ app()->getLocale() }}";
     $(function() {
         $('.singleImage').fileinput({
             theme: 'fa5',
             language: lang,
             allowedFileTypes: ['image'],
             maxFileCount: 1,
             enableResumableUpload: false,
             showUpload: false,

         });

         $('.summernote').summernote({
             height: 150,
         });
     });
 </script>
