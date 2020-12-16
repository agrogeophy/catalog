<html>
<head>
<!--     <title>Table Data Addition</title>
 -->    
    <meta charset="utf-8">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>

 <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet"/>

<!--  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet"/>
 -->
<script src="extensions/export/bootstrap-table-export.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<link href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css" rel="stylesheet">

<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>

<script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF/jspdf.min.js"></script>
<script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>



<link rel="stylesheet" type="text/css" href="extensions/filter-control/bootstrap-table-filter-control.css">

<script src="extensions/filter-control/bootstrap-table-filter-control.js"></script>
 
<!-- <script type="text/javascript" src="https://unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
 -->

  <!-- <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/bootstrap-table.min.js"></script>

  <script src="https://unpkg.com/bootstrap-table@1.14.2/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script> 
 -->

<script src="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.17.1/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script> 
 <script src="https://unpkg.com/bootstrap-table@1.17.1/dist/extensions/export/bootstrap-table-export.min.js"></script>


<!--   <link rel="stylesheet" type="text/css" href="http://bootstrap-table.wenzhixin.net.cn/assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/bootstrap-table.min.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> -->

<!--   <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/bootstrap-table.min.js"></script>
 --><!--   <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/locale/bootstrap-table-pl-PL.min.js"></script> -->

<!--   <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/filter/bootstrap-table-filter.min.js"></script>
<!--  -->  
<!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.9.1/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
 -->
<script>
$(function(){
$(".search").append('<span class="glyphicon glyphicon-search"></span>');
/* add the span inside search div with append box*/
});
</script>

<style>
#result-table {
  position: center;
  padding-bottom: 50px;
  padding-top: 50px;
 }
.search {
      width: 25%;
      position: relative;
    }
    
    .search span {
      position: absolute; /*Set search icon*/
      right: 10px;
      top: 10px;
    }
    .search input[type=text]{
      border-color: red; /*Set the border color for search box*/
    }
    .search input[type=text]:focus{
     outline:none;
     box-shadow:none; /*If you dont need the shadow on click*/
    }
    
    .fixed-table-toolbar .bs-bars,
    .fixed-table-toolbar .search,
    .fixed-table-toolbar .columns {
      position: relative;
      margin-top: 10px;
      margin-bottom: 10px;
      line-height: 34px;
    }

</style>


</head>

<body>

    <div class="container">
        <table id="result-table" data-url="populate_table.php"  data-show-export="true"  data-height="560" data-show-columns="true" class="table table-striped table-bordered" data-search="true" data-filter-control="true" data-filter-show-clear="true">
        <thead>
            <tr>
                <th data-field="contrib_type" data-filter-control="select" data-sortable="true">Contr. type</th>
                <th data-field="contrib_date" data-sortable="true">Date</th>
                <th data-field="contrib_authors" data-sortable="true" data-filter-control="input">Authors</th>
                <th data-field="organisation" data-visible="false" data-filter-control="select"  data-sortable="true">Organisation</th>

                <th data-field="method" data-filter-control="select"  data-sortable="true">Method</th>

                <th data-field="species" data-filter-control="select"  data-sortable="true">Crop type</th>
                <th data-field="organ" data-visible="false" data-filter-control="select"  data-sortable="true">Organ measured</th>

                <th data-field="contrib_title" data-sortable="true" data-filter-control="input">Title</th>


                <th data-field="software_name" data-visible="false" data-filter-control="select"  data-sortable="true">Soft</th>
                <th data-field="licence_type" data-visible="false" data-filter-control="select"  data-sortable="true">Licence</th>
                <th data-field="notebook_filename" data-visible="false" data-filter-control="select"  data-sortable="true">Notebook file</th>
   

                <th data-field="dimension" data-visible="false" data-filter-control="select"  data-sortable="true">Dimension</th>
                <th data-field="spacial_scale" data-visible="false" data-filter-control="select"  data-sortable="true">Spatial scale</th>
                <th data-field="bound_cond" data-visible="false" data-filter-control="select"  data-sortable="true">Bound. cond.</th>
                <th data-field="temporal_scale" data-visible="false" data-filter-control="select"  data-sortable="true">Temp. scale</th>
                <th data-field="instrument" data-visible="false" data-filter-control="select"  data-sortable="true">Instrument</th>
                 
                <th data-field="DOI" data-sortable="true">DOI</th>
                <th data-field="more" data-sortable="true">more</th>
            </tr>
        </thead>
    </table>
    </div>
</body>
</html>



<script>
var $table = $('#result-table');
$table.bootstrapTable();

$('table').dataTable({searching: true});

// Basic example
// oTable = $('#result-table').DataTable();  
// $('#myInputTextField').keyup(function(){
      // oTable.search($(this).val()).draw() ;
// })

</script>