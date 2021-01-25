<!-- jQuery 3 -->

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" charset="utf-8">

// เพิ่มส่วนนี้เข้าไปจะถือว่าเป็นการตั้งค่าให้ Datatable เป็น Default ใหม่เลย
$.extend(true, $.fn.dataTable.defaults, {
    "language": {
              "sProcessing": "กำลังดำเนินการ...",
              "sLengthMenu": "แสดง _MENU_ แถว",
              "sZeroRecords": "ไม่พบข้อมูล",
              "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
              "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
              "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
              "sInfoPostFix": "",
              "sSearch": "ค้นหา:",
              "sUrl": "",
              "oPaginate": {
                            "sFirst": "เริ่มต้น",
                            "sPrevious": "ก่อนหน้า",
                            "sNext": "ถัดไป",
                            "sLast": "สุดท้าย"
              }
     }
});
// เรียกใช้งาน Datatable function
$('.table').DataTable();
</script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<!-- Import Trumbowyg -->
<script src="../../trumbowyg/dist/trumbowyg.min.js"></script>
    <!-- Import all plugins you want AFTER importing jQuery and Trumbowyg -->
    <script src="../../trumbowyg/dist/plugins/cleanpaste/trumbowyg.cleanpaste.min.js"></script>
    <!-- Import all plugins you want AFTER importing jQuery and Trumbowyg -->
    <script src="../../trumbowyg/dist/plugins/colors/trumbowyg.colors.min.js"></script>
    <!-- Import all plugins you want AFTER importing jQuery and Trumbowyg -->
    <script src="../../trumbowyg/dist/plugins/history/trumbowyg.history.min.js"></script>
    <!-- Import all plugins you want AFTER importing jQuery and Trumbowyg -->
    <script src="../../trumbowyg/dist/plugins/noembed/trumbowyg.noembed.min.js"></script>
    <!-- Import all plugins you want AFTER importing jQuery and Trumbowyg -->
    <script src="../../trumbowyg/dist/plugins/resizimg/trumbowyg.resizimg.min.js"></script>
    <!-- Import only if you use JQuery UI with Resizable interaction -->
    <script src="//rawcdn.githack.com/trumbowyg/dist/plugins/resizimg/resizable-resolveconflict.min.js"></script>
    <!-- Import dependency for Resizimg. For a production setup, follow install instructions here: https://github.com/RickStrahl/jquery-resizable -->
    <script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/master/dist/jquery-resizable.min.js"></script>
    <script src="../../trumbowyg/dist/plugins/upload/trumbowyg.upload.min.js"></script>

    <script>
        $('.select2').select2()
        $('#editor-dropdown')
            .trumbowyg({
                btnsDef: {
                    // Create a new dropdown
                    image: {
                        dropdown: ['insertImage', 'upload', 'noembed'],
                        ico: 'insertImage'
                    },
                    resizimg: {
                        minSize: 10,
                        step: 4,
                    }
                },
                // Redefine the button pane
                btns: [
                    ['viewHTML'],
                    ['historyUndo', 'historyRedo'],
                    ['formatting'],
                    ['strong', 'em', 'del'],
                    ['foreColor', 'backColor'],
                    ['superscript', 'subscript'],
                    ['link'],
                    ['image'], // Our fresh created dropdown
                    ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                    ['unorderedList', 'orderedList'],
                    ['horizontalRule'],
                    ['removeformat'],
                    ['fullscreen']
                ],
                plugins: {
                    // Add imagur parameters to upload plugin for demo purposes
                    upload: {
                        serverPath: 'https://api.imgur.com/3/image/{{imageHash}}',
                        fileFieldName: 'image',
                        headers: {
                            'Authorization': 'Client-ID 02f3685ef7d0247'
                        },
                        urlPropertyName: 'data.link',
                    },
                }
            });
    </script>

<!-- CK Editor -->
<!-- <script src="bower_components/ckeditor/ckeditor.js"></script> -->
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- <script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script> -->
<script src="ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('sssss', {
        filebrowserUploadUrl: 'ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
</script>
<script>
    CKEDITOR.replace('aa', {
        filebrowserUploadUrl: 'ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
</script>
