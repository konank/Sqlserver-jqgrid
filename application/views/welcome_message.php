<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="konank" />
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript">
       $(document).ready(function(){
            /*$("#klik").click(function(){
                var category = $("#category").val();
                if(category == ''){
                    $(".eror").html('Masih kosong').delay(1000).fadeOut();
                } else {
                    $.ajax({
                        type : "POST",
                        url : "<?php echo base_url(); ?>index.php/welcome/insert/",
                        dataType:'json',
                        cache : false,
                        data : "category="+category,
                        success : function(s){
                            $(".sukses").html('Sukses').delay(1000).fadeOut();
                            $("#category").val('');
                        }
                    })
                    return false;
                }
            })*/
            
            $('#klik').click(function() {
            var category = $("#category").val();
            $("#category").val('');
            $.post("<?php echo site_url('welcome/insert') ?>", {category: category}, function() {
                $.getJSON("<?php echo site_url('welcome/insert') ?>", function(data) {
                    var contentHtml = "<ol>";
                    $(data).each(function(index, item) {
                        contentHtml += "<li>";
                        contentHtml += item.message;
                        contentHtml += "</li>";
                    });
                    contentHtml += "</ol>";
                    $('#content').html(contentHtml);
                });
            });
        });
       })
       
       
    </script>    
	<title>Untitled 4</title>
</head>

<body>
                         
    <span class="sukses"></span>                     
    <table>
        <tr>
            <td>Category</td>
            <div class="eror"></div>            
            <td><input type="text" name="category" id="category" /></td>            
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="submit" value="insert" id="klik"  /></td> 
                             
        </tr>        
    </table>
    <div id="content"></div>

</body>
</html>