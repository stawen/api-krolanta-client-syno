<?php
	include_once 'config.php';
	include_once '_templates/header.php';
	include_once '_templates/menu.php';

    
?>
<div class="container" role="main">
	<div class="page-header" align="center">
	    <div id="inwork" ><br/><br/><span class="glyphicon glyphicon-refresh glyphicon-spin"></span>&nbsp; Work in progress.....</div>
    	
    	
    	<table id="listFile" class="table table-hover">
            <thead>
                <tr>
                	<th class="col-md-1"></th>
                    <th class="col-md-10"></th>
                    <th class="col-md-1"></th>
               </tr>
            </thead>
                
            <tbody>
            </tbody>
    
        </table>
    </div>
</div>
<?php
include('_templates/footer.php');
?>
<!--appel des scripts personnels de la page -->
	<script src="js/dlinfo.js"></script>
    </body>
</html>