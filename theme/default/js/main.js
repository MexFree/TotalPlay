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

var Site = {
    WebEdit: function (id, name, url, online) {
        $("#l_name").val(name);
        $("#l_url").val(unescape(url));
        $("#l_online").val(online);
        $("#l_id").val(id);
        $("#fg").data("api", "site_webedit");
        $(".btn-inverse").html("Actualizar");
        $(".btn-danger").css("display", "inline-block");
    },
    WebDelete: function (id) {
        $("#fg").html('<input type="hidden" name="l_id" value="' + id + '" />');
        $("#fg").data("api", "site_webdelete");
        $("#fg").submit();
    }
}

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