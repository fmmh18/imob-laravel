import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Theme Scss
                'resources/scss/app.scss',
                'resources/scss/icons.scss',
                'node_modules/jquery-toast-plugin/dist/jquery.toast.min.css',
                'node_modules/select2/dist/css/select2.min.css',
                'node_modules/daterangepicker/daterangepicker.css',
                'node_modules/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css',
                'node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
                'node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
                'node_modules/flatpickr/dist/flatpickr.min.css',
                'node_modules/quill/dist/quill.core.css',
                'node_modules/quill/dist/quill.snow.css',
                'node_modules/quill/dist/quill.bubble.css',
                'node_modules/cropper/dist/cropper.min.css',
                'node_modules/x-editable/dist/bootstrap-editable/css/bootstrap-editable.css',
                'node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css',
                'node_modules/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css',
                'node_modules/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css',
                'node_modules/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css',
                'node_modules/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css',
                'node_modules/datatables.net-select-bs5/css/select.bootstrap5.min.css',
                'node_modules/admin-resources/rwd-table/rwd-table.min.css',
                'node_modules/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css',

                // Theme Js
                'resources/js/main.js',
                'resources/js/layout.js',
                'resources/js/head.js',
                'resources/js/config.js',
                'resources/js/pages/dashboard.js',
                'resources/js/pages/toastr.init.js',
                'resources/js/pages/range-slider.init.js',
                'resources/js/pages/icons-remix.init.js',
                'resources/js/pages/icons-bootstrap.init.js',
                'resources/js/pages/icons-mdi.init.js',
                'resources/js/pages/apex.init.js',
                'resources/js/pages/chartjs-area.init.js',
                'resources/js/pages/sparkline.init.js',
                'resources/js/pages/form-advanced.init.js',
                'resources/js/pages/form-wizard.init.js',
                'resources/js/pages/fileupload.init.js',
                'resources/js/pages/quilljs.init.js',
                'resources/js/pages/form-imagecrop.init.js',
                'resources/js/pages/form-xeditable.init.js',
                'resources/js/pages/datatable.init.js',
                'resources/js/pages/tabledit.init.js',
                'resources/js/pages/responsive-table.init.js',
                'resources/js/pages/google-maps.init.js',
                'resources/js/pages/vector-maps.init.js',

                //COMPONENTES
                'resources/js/components/invoice-to-pay/invoicetopay.js',
                'resources/js/components/invoice/invoice.js',
                'resources/js/components/all/delete.js',
                'resources/js/components/company/company.js',


                'resources/images/logo-cms-128.png',
                'resources/images/logo-cms.png',
            ],
            refresh: true,
        }),
    ],
});
