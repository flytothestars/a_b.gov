

    var attributes = {
        codebase: '/java/kalkan/',
        code: 'kz.gov.pki.knca.applet.MainApplet',
        archive: 'AuthApplet.jar',
        id: 'KncaApplet',
        name: 'KncaApplet',
        width: 1,
        height: 1
    };

    var parameters = {
        mayscript: 'true',
        scriptable: 'true',
        language: 'ru',
        separate_jvm: 'true',
        codebase_lookup: 'false'
    };

    var version = '1.6';

    var runner = 'applet';

    var kalkan = null;

    $(document).ready(function () {
        //console.log('height ' +$('.flex-slide').height());
        
        //$('.flex-title').height($('.flex-slide').height());
        //$('.flex-title').height($('.flex-slide').width());
         $(window).resize(function() {
            //$('.flex-title').height($('.flex-slide').height());
            //$('.flex-title').height($('.flex-slide').width());
        });

        $('#keyRefreshButton').hide();
        $('#keyListLabel').hide();
        $('#keyList').hide();
        $('#binIndexLabel').hide();
        $('#binIndexDiv').hide();
        $('#binKeys').hide();

        $('#keyPassword').keyup(function (e) {
            if (e.keyCode == 13) {
                authByCert();
            }
        });

    });

    function initialize() {

        var storageId = $('#storageId');
        var password = $('#keyPassword').val();
        var storageAlias = $('#storageAlias').val();
        var storagePath = $('#storagePath').val();

    }

    kalkan = new Kalkan('127.0.0.1', 13579, true, LayerIsReady, LayerError);

    function LayerIsReady()
    {
        runner = 'NCALayer';
        AppletIsReady();
    }

    function AppletIsReady()
    {
        $('#aplstatus').html('<br /><?= ("Выберите источник сертификата"); ?><br /><br />');
        $('#selectP12File').show();
        $('#Etoken').show();
    }

    function LayerError()
    {
       $('#aplstatus').html('<p class="text-warning"><br/><img src="/images/nca.png" /><br/><br/><?= ("Для авторизации запустите приложение NCALayer"); ?><br /></p>');
    }

    function updateAjaxResult(message, type) {

        $('.result').html(message).removeClass('bg-danger').addClass(type || 'bg-danger');
    }

    function showPasswordDialog() {
        $('#passwordDialog').modal('show');
    }

    function showLoginDialog() {
        $('#loginDialog').modal('show');
    }

    function chooseStoragePath(storage) {

        var storageAlias = storage || $("#storageAlias").val();
        var storagePath = $("#storagePath").val();

        if (storage)
            $("#storageAlias").val(storage);

        if (storageAlias !== "NONE") {

            if(runner == 'NCALayer') {

                kalkan.browseKeyStore(storageAlias, "P12", storagePath, function (rw) {
                    if (rw.getErrorCode() === "NONE") {
                        storagePath = rw.getResult();
                        if (storagePath !== null && storagePath !== "") {
                            $("#storagePath").val(storagePath);
                            $('#passwordDialog').modal('show');
                        }
                        else {
                            $("#storageAlias").val("NONE");
                            $("#storagePath").val("");
                        }
                    } else {
                        alert(rw.getErrorCode());
                        $("#storageAlias").val("NONE");
                        $("#storagePath").val("");
                    }
                });

            } else {

                var rw = document.getElementById('KncaApplet').browseKeyStore(storageAlias, "P12", storagePath);

                if (rw.getErrorCode() === "NONE") {
                    storagePath = rw.getResult();
                    if (storagePath !== null && storagePath !== "") {
                        $("#storagePath").val(storagePath);
                        $('#passwordDialog').modal('show');
                        $('#keyPassword').focus();
                    }
                    else {
                        $("#storageAlias").val("NONE");
                        $("#storagePath").val("");
                    }
                } else {
                    alert(rw.getErrorCode());
                    $("#storageAlias").val("NONE");
                    $("#storagePath").val("");
                }
            }

        }
        else {
            storagePath = $("#storagePath").val("");
        }
    }

    function authByCert() {

        fillKeys(function(){
            signXml(function (result) {
                sendSignature(result);
            });
        });

        $('#passwordDialog').modal('hide');
    }

    function signXml(callback) {

        keysOptionChanged();

        var storageAlias = $("#storageAlias").val();
        var storagePath = $("#storagePath").val();
        var password = $("#keyPassword").val();
        var alias = $("#keyAlias").val();

        updateAjaxResult('Авторизация...<br /> <img src="/images/file_loader.gif" />', 'info');

        if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {
            if (password !== null && password !== "") {
                if (alias !== null && alias !== "") {

                    var data = document.getElementById("logonTicketRequest").value;

                    if (data !== null && data !== "") {

                        if(runner == 'NCALayer') {

                            kalkan.authXml(storageAlias, storagePath, "", "", data, function (rw) {
                                if (rw.getErrorCode() === "NONE") {
                                    document.getElementById("logonTicketResponse").value = rw.getResult();
                                    callback(document.getElementById("logonTicketResponse").value);
                                }
                                else {
                                    if (rw.getErrorCode() === "WRONG_PASSWORD" && rw.getResult() > -1) {
                                        alert("<?= _('Указан неверный пароль'); ?>.<?= _('Осталось попыток'); ?>: " + rw.getResult());
                                    } else if (rw.getErrorCode() === "WRONG_PASSWORD") {
                                        alert("<?= _('Указан неверный пароль'); ?>");
                                    } else {
                                        document.getElementById("logonTicketResponse").value = "";
                                        alert(rw.getErrorCode());
                                    }
                                }
                            });
                        } else {

                            var rw = document.getElementById('KncaApplet').signXml(storageAlias, storagePath, alias, password, data);

                            if (rw.getErrorCode() === "NONE") {
                                document.getElementById("logonTicketResponse").value = rw.getResult();
                                callback(document.getElementById("logonTicketResponse").value);
                            }
                            else {
                                if (rw.getErrorCode() === "WRONG_PASSWORD" && rw.getResult() > -1) {
                                    alert("<?= _('Указан неверный пароль'); ?>.<?= _('Осталось попыток'); ?>: " + rw.getResult());
                                } else if (rw.getErrorCode() === "WRONG_PASSWORD") {
                                    alert("<?= _('Указан неверный пароль'); ?>");
                                } else {
                                    document.getElementById("logonTicketResponse").value = "";
                                    alert(rw.getErrorCode());
                                }
                            }
                        }
                    }
                    else {
                        updateAjaxResult('<?= ("Данные не указаны"); ?>');
                    }
                } else {
                    updateAjaxResult('<?= ("Ключ не выбран"); ?>');
                }
            } else {
                alert('<?= ("Введите пароль к хранилищу"); ?>');
            }
        } else {
            updateAjaxResult('<?= ("Не выбрано хранилище"); ?>');
        }
    }

    function sendSignature(signature) {

        $.ajax({
            type: "POST",
            url: "/<?= lkey(); ?>/user/sendsign/kz",
            data: {sign: signature},

            success: function (data, status) {
                updateAjaxResult(data, 'info');
            },
            error: function () {
                updateAjaxResult('<?= ("Ошибка сервера"); ?>');
            }
        });
    }

    function fillKeys(callback) {

        var storageAlias = $("#storageAlias").val();
        var storagePath = $("#storagePath").val();
        var password = $("#keyPassword").val();
        var keyType = "AUTH";
        var keys = $('#keys');

        if (storagePath !== null && storagePath !== "" && storageAlias !== null && storageAlias !== "") {

            if (password !== null && password !== "") {

                if(runner == 'NCALayer') {

                    kalkan.getKeys(storageAlias, storagePath, password, keyType, function (rw) {

                        if (rw.getErrorCode() === "NONE") {

                            keys.html('');

                            var list = rw.getResult();
                            var slotListArr = list.split("\n");

                            $.each(slotListArr, function (key, value) {
                                keys.append($("<option></option>")
                                    .attr("value", key)
                                    .text(value));
                            });

                            if(callback)
                                callback(slotListArr);
                        }
                        else {

                            if (rw.getErrorCode() === "WRONG_PASSWORD" && rw.getResult() > -1) {
                                alert("<?= _('Указан неверный пароль'); ?>.<?= ('Осталось попыток'); ?>: " + rw.getResult());
                            } else if (rw.getErrorCode() === "WRONG_PASSWORD") {
                                alert("<?= _('Указан неверный пароль'); ?>");
                            } else {
                                alert(rw.getErrorCode());
                            }

                            keys.html('');
                        }
                    });

                } else {

                    var rw = document.getElementById('KncaApplet').getKeys(storageAlias, storagePath, password, keyType);

                    if (rw.getErrorCode() === "NONE") {
                        var keyListEl = document.getElementById('keys');
                        keyListEl.options.length = 0;
                        var list = rw.getResult();
                        var slotListArr = list.split("\n");
                        for (var i = 0; i < slotListArr.length; i++) {
                            if (slotListArr[i] === null || slotListArr[i] === "") {
                                continue;
                            }
                            keyListEl.options[keyListEl.length] = new Option(slotListArr[i], i);
                        }
                        keysOptionChanged();
                    }
                    else {
                        if (rw.getErrorCode() === "WRONG_PASSWORD" && rw.getResult() > -1) {
                            alert("<?= _('Указан неверный пароль'); ?>.<?= _('Осталось попыток'); ?>: " + rw.getResult());
                        } else if (rw.getErrorCode() === "WRONG_PASSWORD") {
                            alert("<?= _('Указан неверный пароль'); ?>");
                        } else {
                            alert(rw.getErrorCode());
                        }
                        var keyListEl = document.getElementById('keys');
                        keyListEl.options.length = 0;
                    }
                }

            } else {
                updateAjaxResult('<?= ("Введите пароль к хранилищу"); ?>');
            }
        } else {
            updateAjaxResult('<?= ("Не выбрано хранилище"); ?>');
        }

        if(callback)
            callback(null);
    }

    function keysOptionChanged() {
        var alias = $("#keys :selected").text().split("|")[3];
        console.log(alias);
        $("#keyAlias").val(alias);
    }

    function selectKey(key)
    {
        const crf = $('input[name="_token"]').val()
        let storageAlias = key || 'PKCS12';
        let storagePath = '';

        $('#result').hide();

        let path = $('#path').val();
        let newDate = new Date();
        const data = `<?xml version="1.0" encoding="UTF-8"?><login><timeTicket>${newDate}</timeTicket></login>`
       
            kalkan.authXml(storageAlias, storagePath, "", "", data, function (rw) {
                if(rw.responseObject) {
                    $('input[name="sign"]').val(rw.responseObject);
                    $('#loginForm').submit();
                   // $.post('login', {sign: rw.responseObject, type: 'modal', path: path, _token: crf}, function(response) {}, 'json');
                } else if(rw.message) {
                    switch (rw.message) {
                        case 'storage.empty':
                            $('#result').html('Выбранное устройство недоступно').show();
                            break;
                    }
                }
            });
       
    }


    function selectKey2(key)
    {
        $('#regForm').submit();
        const crf = $('input[name="_token"]').val()
        let storageAlias = key || 'PKCS12';
        let storagePath = '';

        $('#result').hide();

        let path = $('#path').val();
        let newDate = new Date();
        const data = `<?xml version="1.0" encoding="UTF-8"?><login><timeTicket>${newDate}</timeTicket></login>`
       
            kalkan.authXml(storageAlias, storagePath, "", "", data, function (rw) {
                if(rw.responseObject) {
                    $('input[name="sign_register"]').val(rw.responseObject);
                    $('#registerForm').submit();
                   // $.post('login', {sign: rw.responseObject, type: 'modal', path: path, _token: crf}, function(response) {}, 'json');
                } else if(rw.message) {
                    switch (rw.message) {
                        case 'storage.empty':
                            $('#result').html('Выбранное устройство недоступно').show();
                            break;
                    }
                }
            });
       
    }


    

