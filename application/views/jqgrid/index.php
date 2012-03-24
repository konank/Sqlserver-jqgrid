<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="konank" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>themes/flick/jquery-ui-1.8.16.custom.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/ui.jqgrid.css"/>
    <style type="text/css">
    html, body {
        margin: 0;
        padding: 0;
        font-size: 75%;
    }
    </style>

    <script type="text/javascript" src="<?php echo base_url() ?>jquery-1.5.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/i18n/grid.locale-en.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery.jqGrid.min.js"></script>
	<title>Untitled 2</title>
</head>

<body>
<div style="margin: 0 auto; width: 100%;">

<script type="text/javascript">
            jQuery().ready(function (){
                jQuery("#daftarsiswa").jqGrid({
                    url:'<?php echo base_url().'index.php/jqgrid/tampil_data'?>',
                    mtype : "GET",
                    datatype: "json",
                    
                    height:"auto", //tinggi sesuaikan sama datanya
                    colNames:['Nomor','nama siswa','alamat','kelas','Status','id'], //nama kolom
                    colModel:[
                        //data field dari database
                        {name:'nomor',index:'nomor', width:10, align:"center",},
                        {name:'namasiswa',index:'namasiswa', width:40,editrules:{required:true}, align:"center",editable:true},
                        {name:'alamat',index:'alamat',editoptions: {rows:"4",cols:"15"},edittype:'textarea', width:40, align:"center",editable:true},
                        {name:'kelas',index:'kelas', width:40, align:"center",editable:true},
                        {name:'status',index:'status', width:10,editoptions: { value: "0:Not active; 1:Active" },edittype:'select', align:"center",editable:true},
                        {name:'id',index:'id',hidden:true, width:10, align:"center",}
                    ],
                    rowNum:10,
                    rownumbers:true,
                    width: 1360,
                    rowList:[10,20,30,40,50,60,70],
                    pager: '#pager1',
                    sortname: 'namasiswa',
                    viewrecords: true,
                    sortorder: "desc",
                    multiselect: true, 
                    editurl: '<?php echo base_url() ?>index.php/jqgrid/crud',
                    caption:"Daftar Nama-Nama Siswa"
                });
                jQuery("#daftarsiswa").jqGrid('navGrid','#pager1',
                {view:true,edit:true,add:true,del:true,search:true,viewtext:'View',refreshtext:'Reload',excel:true}, //View options
    			{editCaption: "Edit Record",}, // edit options
    			{addCaption: "Add Record",}, // add options
    			{}, // del options
                
    			{closeOnEscape:true,closeAfterSearch:false,multipleSearch:false, multipleGroup:false, showQuery:false,drag:true,showOnLoad:false,sopt:['cn'],resize:true,caption:'Cari Record', Find:'Cari', Reset:'Batalkan Pencarian'}
                
    		)
            //tambahan untuk export excel
            .navButtonAdd('#pager1',{
                caption:"Export to Excel", 
                buttonicon:"ui-icon-save", 
                
                onClickButton: function(){ 
                  exportExcel();
                }, 
                position:"last"
            });
            function exportExcel($id){
              var keys=[], ii=0, rows="";
              var ids=$("#daftarsiswa").getDataIDs();;  // Get All IDs
               //mya=$("#daftarsiswa").getDataIDs();  // Get All IDs
              var row=$("#daftarsiswa").getRowData(ids[0]);     // Get First row to get the labels
              
              for (var k in row) {
                keys[ii++]=k;    // capture col names
                rows=rows+k+"\t";     // output each Column as tab delimited
              }
              rows=rows+"\n";   // Output header with end of line
              for(i=0;i<ids.length;i++) {
                row=$("#daftarsiswa").getRowData(ids[i]); // get each row
                //data=$("#daftarsiswa").getRowData(ids[i]);
                for(j=0;j<keys.length;j++) rows=rows+row[keys[j]]+"\t"; // output each Row as tab delimited
                rows=rows+"\n";  // output each row with end of line
              }
              rows=rows+"\n";  // end of line at the end
              var form = "<form name='csvexportform' action='<?php echo base_url() ?>index.php/jqgrid/csv' method='post'>";
              form = form + "<input type='hidden' name='csvBuffer' value='"+rows+"'>";
              form = form + "</form><script>document.csvexportform.submit();</sc"+"ript>";
              OpenWindow=window.open('', '');
              OpenWindow.document.write(form);
              OpenWindow.document.close();
            }
            


});
        </script>

        <table id="daftarsiswa"></table>
        <div id="pager1"></div>

</div>


</body>
</html>