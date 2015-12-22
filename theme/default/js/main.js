/* 
 * Proyecto progamado por xlFederalElk0lx.
 * Informes coil811122@icloud.com
 */


$(function () {
    $("form").submit(function () {
        try {
            Curl(this);
        } catch (error) {
            alert(error);
        }
        return false;
    });
    try {
        $("input")[0].focus();
    } catch (error) {
        
    }
});

function Curl(form) {
    try {
        var api = $(form).data('api');
        if (api != '') {
            var formData = new FormData(form);
            var res = $(form).data('res');
            if (res == '' || res == undefined) {
                res = ".api-gral";
            }
            var metodo = $(form).data('metodo');
            if (metodo == '' || metodo == undefined) {
                metodo = "post";
            }
            $("." + res).html('<h5 class="fa fa-spinner fa-pulse fa-fw margin-bottom"></h5>Procesando Peticion');
            $.ajax({
                type: metodo,
                url: "/api/" + api,
                enctype: 'multipart/form-data',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function (data) {
                $("." + res).html(data);
            }).fail(function () {
                $("." + res).html('<div class="alert alert-danger" role=alert> <strong><span class="fa fa-warning"></span></strong>Error no se logro encontrar el recurso solicitado. </div>');
            });
        }
    } catch (error) {
        alert(error);
    }
}