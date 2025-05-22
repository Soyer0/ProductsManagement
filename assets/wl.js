let wl = {
    loader: {
        'loadedClass': '',
        'fadingClass': '',
        'fadingTime': 50
    },
    // echo: false / swal / gritter / all
    ajax: function (url, data = {}, echo = 'all', hide_modal = false, type = "POST", contentType = "application/x-www-form-urlencoded; charset=UTF-8") {
        return new Promise(function (resolve, reject) {
            if (url.substr(0, 4) != 'http') {
                url = ADMIN_URL + url;
            }
            var processData = true;
            if (contentType == 'multipart/form-data' || data instanceof FormData) {
                processData = false;
                contentType = false; // fix bug
            }
            if (hide_modal) {
                $('.modal').modal('hide');
            }
            $('#loader').removeClass('loaded').css('background', 'rgb(0 0 0 / 20%)');

            $.ajax({
                url: url,
                type: type,
                data: data,
                processData: processData,
                contentType: contentType,
                success: function (res) {
                    if (echo != false && echo != 'false') {
                        if (res === 'false' || res === false)
                            res = { status: false };
                        if (res === 'true' || res === true)
                            res = { status: true };
                        if (res.status === undefined || res.status === '' || res.status === 'false' || res.status === false)
                            res.status = 'error';
                        if (res.status === 'true' || res.status === true)
                            res.status = 'success';
                        if (res.title === undefined || res.title === '')
                            res.title = res.status.charAt(0).toUpperCase() + res.status.slice(1) + '!';
                        if (res.text === undefined)
                            res.text = '';
                        if (res.icon === undefined || res.icon === '')
                            res.icon = res.status;

                        if (echo == 'swal' || echo == 'all') {
                            Swal.fire( {
                                icon: res.status,
                                title: res.title,
                                text: res.text
                            } );
                        }
                        if (echo == 'gritter' || echo == 'all') {
                            $.gritter.add({
                                title: res.title,
                                text: res.text,
                                sticky: false,
                                time: 3000
                            });
                        }
                    }
                    resolve(res);
                },
                error: function () {
                    Swal.fire( {
                        icon: "error",
                        title: "Error!",
                        text: "Try Again!"
                    } );
                    reject("Error!");
                },
                timeout: function () {
                    Swal.fire( {
                        icon: "error",
                        title: "Timeout Error!",
                        text: "Try Again!"
                    } );
                    reject("Timeout Error!");
                },
                complete: function () {
                    setTimeout(function () {
                        $('#loader').removeClass(wl.loader.fadingClass).addClass(wl.loader.loadedClass);
                    }, wl.loader.fadingTime);
                }
            });
        });
    },
    fileUpload: function (input, url, data = false, echo = false) {
        var fd = new FormData();
        if (data) {
            if (data instanceof FormData) {
                fd = data;
            }
            else {
                for (var key in data) {
                    fd.append(key, data[key]);
                }
            }
        }
        
        var files = $(input)[0].files[0];
        fd.append($(input).attr('name'), files);

        return this.ajax(url, fd, echo);
     },
    formSubmit: function (el) {
        let form = $(el),
            data = {},
            notify = 'all',
            hide_modal = false,
            clear_inputs = true;

        if (form.data('notify') == 'false' || form.data('notify') == 'swal' || form.data('notify') == 'gritter') {
            notify = form.data('notify');
        }

        if (form.data('clear_inputs') == 'false' || form.data('clear_inputs') == false) {
            clear_inputs = false;
        }
        if (form.data('hide_modal') == 'true' || form.data('modal') == 'hide') {
            hide_modal = true;
        }

        if (form.data('before')) {
            if ( typeof window[ form.data( 'before' ) ] === "function" ) {
                window[ form.data( 'before' ) ]( res );
            } else {
                eval( form.data( 'before' ) );
            }
        }

        if (form.prop('enctype') == 'multipart/form-data')
            data = new FormData(el);
        else
            data = form.serialize();

        this.ajax(form.prop('action'), data, notify, hide_modal, form.prop('method'), form.prop('enctype'))
            .then((res) => {
                if (res === 'true' || res === true || res.status == 'success' || res.status === 'true' || res.status === true) {
                    if (form.data('after')) {
                        if (typeof window[form.data('after')] === "function") {
                            window[form.data('after')](res);
                        } else {
                            eval(form.data('after'));
                        }
                    }
                    if (clear_inputs) {
                        form.find('input').val('');
                    }
                }
                else {
                    if (res === 'false' || res === false)
                        res = { status: false };
                    if (res.status === undefined || res.status === '' || res.status === 'false' || res.status === false)
                        res.status = 'error';
                    if (res.title === undefined || res.title === '')
                        res.title = res.status.charAt(0).toUpperCase() + res.status.slice(1) + '!';
                    if (res.text === undefined)
                        res.text = '';
                    if (res.icon === undefined || res.icon === '')
                        res.icon = res.status;

                    swal({
                        title: res.title,
                        text: res.text,
                        icon: res.icon
                    });
                }
            });

        return false;
    },
    loadPage: function (url, data = {}, type = "GET", hide_modal = true) {
        if (url.substr(0, 4) != 'http') {
            url = ADMIN_URL + url;
        }
        window.history.pushState("", "", url);
        if(hide_modal) {
            $('.modal').modal('hide');
        }
        $('#loader').removeClass('loaded').css('background', 'rgb(0 0 0 / 20%)');
        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function (res) {
                $('#content').html(res);
            },
            timeout: function () {
                swal({
                    title: "Timeout Error!",
                    text: "Try Again!",
                    icon: "error"
                });
            },
            complete: function () {
                setTimeout(function () {
                    $('#loader').removeClass(app.loader.fadingClass).addClass(app.loader.loadedClass);
                }, wl.loader.fadingTime);
            }
        });
    },
    // doesn't supports in IE
    getGetParamsAsObject: function () {
        let objParams = {};
        let getParams = new URLSearchParams(window.location.search);

        for(const entry of getParams.entries()) {
            objParams[entry[0]] = entry[1];
        }

        return objParams;
    },
    setGetParamsAsObject: function (getObj) {
        let getParams = new URLSearchParams(window.location.search);
        for (const [key, value] of Object.entries(getObj)) {
            getParams.set(key, value);
        }

        return getParams;
    }
}