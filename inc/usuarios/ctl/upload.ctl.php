<?php
$this->establecerTitulo("Upload");
$script = <<<EOM
$(function () {
    'use strict';
    var url = "/upload/usuarios/";
    $('#fileuploadlogotipo').fileupload({
        url: url,
        dataType: 'json',
        filesContainer: '#filesdisponibles',
		dropZone: $('#dropzone'),
        done: function (e, data) {
			console.log("LISTO");
			$.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo('#filesdisponibles');
            });
		},
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

    $.getJSON(url, function (files) {
        console.log(files);
    });
});
EOM;
$this->agregarScript($script);

$uploadCampo = \DepotServer\DSUploader::generar("logotipo", "/upload/usuarios/");
$this->ev("campoCarga", $uploadCampo["campo"]);
//$this->agregarScript($uploadCampo["script"]);