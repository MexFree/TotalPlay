/* 
 * Proyecto progamado por xlFederalElk0lx.
 * Informes coil811122@icloud.com
 */


$(function () {
    $("form").submit(function () {
        try {
            return TotalPlay.Curl(this);
        } catch (error) {
            alert(error);
        }
        return false;
    });
    try {
        $("input")[0].focus();
    } catch (error) {

    }
    try {
        $(".nano").nanoScroller();
    } catch (error) {

    }
});
var Site = {
    TableWebs: function () {
        $("#movie_table").dataTable({
            'searching': true,
            "order": [[1, "asc"]],
            stateSave: true
        });
        $(".paginate_button_add").click(function () {
            $(".page-header").html("Agregar web");
            $(".listado").hide("slow", function () {
                $("#fg").show("slow");
                $("#fg").data("api", "site_webadd");
                $("input")[0].focus();
            });
        });
        $(".btn-danger").click(function () {
            location.reload();
        });
    },
    WebEdit: function (id, name, url, online) {
        $(".listado").hide("slow", function () {
            $("#l_name").val(name);
            $("#l_url").val(unescape(url));
            $("#l_online").val(online);
            $("#l_id").val(id);
            $("#fg").show("slow");
            $("#fg").data("api", "site_webedit");
            $(".btn-inverse").html("Actualizar");
            $("input")[0].focus();
        });
    },
    WebDelete: function (id) {
        $("#fg").html('<input type="hidden" name="l_id" value="' + id + '" />');
        $("#fg").data("api", "site_webdelete");
        $("#fg").submit();
    }
}

var Movie = {
    TableVideos: function (titulo, id) {
        $("#movie_table").dataTable({
            'searching': true,
            "order": [[1, "asc"]],
            stateSave: true
        });
        $(".paginate_button_add").click(function () {
            $(".page-header").html(titulo + ": Agregar reproductor");
            $(".listado").hide("slow", function () {
                $("#fg").show("slow");
                $("#fg").data("api", "movie_videoadd");
            })
        });
        $(".btn-danger").click(function () {
            window.location.href = '/Movies/Videos/' + id;
        });
    },
    TableMovie: function () {
        $("#movie_table").dataTable({
            'searching': true,
            "order": [[1, "asc"]],
            stateSave: true
        });
        $(".paginate_button_add").click(function () {
            $(".page-header").html("Agregar pelicula");
            $(".listado").hide("slow", function () {
                $("#fg").show("slow");
                $("#fg").data("api", "movie_add");
                $("input")[0].focus();
            })
        });
        $(".btn-danger").click(function () {
            location.reload();
        });
        $(".btn-primary").click(function () {
            $("#caratula").click();
        });
    },
    VideosUpdate: function (json) {
        $.each(json, function (key, value) {
            $("#" + key).val(value);
        });
        $(".page-header").html("Actualizar Reproductor");
        $(".listado").hide("slow", function () {
            $("#fg").show("slow");
            $("#fg").data("api", "movie_videoedit");
            $("input")[0].focus();
            $(".btn-inverse").html("Actualizar");
        });
    },
    VideosDelete: function (v_id, p_id) {
        $("#fg").data("api", "movie_videodelete");
        $("#fg").html('<input type="hidden" name="v_id" value="' + v_id + '"/>');
        $("#fg").append('<input type="hidden" name="p_id" value="' + p_id + '"/>');
        $("#fg").submit();
    },
    Delete: function (p_id) {
        $("#fg").data("api", "movie_delete");
        $("#fg").append('<input type="hidden" name="p_id" value="' + p_id + '"/>');
        $("#fg").submit();
    },
    Update: function (json) {
        $.each(json, function (key, value) {
            if (key != 'p_date' && key != 'p_seo' && key != 'p_hits' && key != 'p_votos' && key != 'p_reports') {
                $("#" + key).val(value);
            }
        });
        $("fieldset").html('<img src="/files/uploads/' + json.p_id + '.jpg" height="235" width="192" />');
        $(".page-header").html("Actualizar pelicula");
        $(".listado").hide("slow", function () {
            $("#fg").show("slow");
            $("#fg").data("api", "movie_update");
            $("input")[0].focus();
        });
    }
}

var TotalPlay = {
    VerPelicula: function (id) {
        TotalPlay.CreateJCarousel('relacionadas');
        $(".btn-votos").click(function () {
            TotalPlay.Post("movie_like", {id: id}, "api-movie");
        });
        $(".btn-report").click(function () {
            TotalPlay.Post("movie_report", {id: id}, "api-movie");
        });
        $(".source").click(function () {
            var source = unescape($(this).data("key"));
            $("#player").html(source);
            $("#player iframe").css("width", "100%");
        });
        setTimeout(function () {
            $(".source")[0].click();
        }, 5000);
    },
    CreateJCarousel: function (name) {
        $('.' + name).jcarousel({
            wrap: 'circular'
        });
        $('.' + name + '-prev').jcarouselControl({
            target: '-=2'
        });
        $('.' + name + '-next').jcarouselControl({
            target: '+=2'
        });
    },
    Post: function (api, post, res) {
        if (res == '' || res == undefined) {
            res = "api-gral";
        }
        $.post("/api/" + api, post).done(function (data) {
            $("." + res).html(data);
        }).fail(function () {
            alert("error en el recurso");
        });
    },
    Curl: function (form) {
        try {
            var api = $(form).data('api');
            if (api != '' && api != undefined) {
                var formData = new FormData(form);
                var res = $(form).data('res');
                if (res == '' || res == undefined) {
                    res = ".api-gral";
                }
                var metodo = $(form).data('metodo');
                if (metodo == '' || metodo == undefined) {
                    metodo = "post";
                }
                $("." + res).html('<center><h5><img src="data:image/gif;base64,R0lGODlhEAAQAIABAAAAAP///yH/C05FVFNDQVBFMi4wAwEAAAAh+QQJCgABACwAAAAAEAAQAAACHYyPqcvtD6M0oAJo78vYzsOFXiBW5Fhe3GmmX1AAACH5BAkKAAEALAAAAAAQABAAAAIcjI+py+0PowIUwGofvlXKDXZBSI0iaW1miXpGAQAh+QQJCgABACwAAAAAEAAQAAACH4yPacCg2txDcdJms62aZ79h2ngxAXhU6IKtZyuSTwEAIfkECQoAAQAsAAAAABAAEAAAAiCMj2nAEO0UfE1RdmOa03rbfZm4VGRIpiV2miLqwepXAAAh+QQJCgABACwAAAAAEAAQAAACHoyPacAQ7eBqj8rKcKS6XwUeX9iRU2aW6cq27guDBQAh+QQJCgABACwAAAAAEAAQAAACHoyPacAQ7eBqj8rKcKS6XwWGySeSoQmi4sq27guDBQAh+QQJCgABACwAAAAAEAAQAAACHoyPqQEN7JZ7U8aqKl68m92BnGg13lk+J5lFq4seBQAh+QQJCgABACwAAAAAEAAQAAACHoyPqQoNm9yDR9Lqrl5W9/tR4cZlo2GdQZoxZksaBQA7" /></h5></center>');
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
                return false;
            } else {
                return true;
            }
        } catch (error) {
            alert(error);
        }
    }
}