$(document).ready(function() {

    function addFilesRow(json) {
        /*
        var typeClass 	= (json.folder)?'class="warning"':'';
        var icon 		= (json.folder)?'<span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>':'<span class="glyphicon glyphicon-file" aria-hidden="true"></span>';
        var name 		= (json.folder)?'<a href=# class="folder" data-path="'+ path +'">'+ json.name + '</a>':'<a class="file" href="#" data-url="'+json.url+'" data-name="'+json.name+'">'+ json.name + '</a>'; //nasdown.php?file='+ json.url +'
        var mosaic 		= '';
        var sample 		= '';
        */

        var typeClass, status;

        switch (json.status) {
            case 'finished':
                typeClass = 'class="success"';
                status = '<button type="button" class="btn btn-xs" id="delete" data-id="' + json.id + '"><span class="glyphicon glyphicon-trash" aria-hidden="true" ></span></button>';
                break;
            case 'downloading':
                typeClass = 'class="info"';
                status = '<span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>';
                break;
            default:
                status = json.status;


        }

        $('#listFile > tbody:last').append('<tr ' + typeClass + '> \
		                                        <td><span class="glyphicon glyphicon-file" aria-hidden="true"></span></td>\
												<td> ' + json.title + '</td>\
												<td> ' + status + '</td>\
		                                    </tr>');
    }


    function getlistDlFile() {
        $.api('GET', 'listDlFile', {}, 'www').done(function(json) {

            $("#inwork").hide();
            $("#listFile> tbody").html("");

            if (json.length === 0) {
                $('#listFile > tbody:last').append('<tr> \
												<td> </td>\
												<td> Vide </td>\
		                                        <td> </td> \
		                                    </tr>');
            }
            $.each(json, function(key, val) {
                addFilesRow(val);
            });
        });
    }

    $("body").on("click", "#delete", function(b) {
        //var id = $(this).data('id');

        $.api('GET', 'deleteFileQueue', { 'id': $(this).data('id') }, 'www').done(function(json) {
            console.log(json);
            if (json[0].error === 0) {
                $.growlValidate("Fichier retiré de la liste");
                getlistDlFile();
            } else {
                $.growlErreur("Erreur dans la suppression");
            }

        });


    });

    getlistDlFile();

});