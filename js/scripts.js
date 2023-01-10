$(function() {

    $("#form").on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            dataType: "html",
            data: form.serialize(),
            success: processServerResponse
        });
    });

    $('#phone_number_del').on('keyup', function(){
        let search = $(this).val();
        let form = $(this);
        if ((search != '') && (search.length > 1)) {
            $.ajax({
                type: "POST",
                url: 'search',
                dataType: "html",
                data: {'search': search},
                success: function (msg) {
                    $('#for-delete-result').html(msg);
                }
            });
        }
    });

    $(document).on('click', '#search-result', function(){
        $(this).closest('form').find('.phone_number_search').val($(this).text());
        $(this).closest('form').find('.phone_number_search').data('id', $(this).data('id'));
        $(this).closest('form').find('.for-search-result').html('');
        return false;
    });

    $("#form-del").on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            dataType: "html",
            data: {'phone_id_del': $('#phone_number_del').data('id')},
            success: processServerResponseDelete
        });
    });

    $('#phone_number_search').on('keyup', function(){
        let search = $(this).val();
        let form = $(this);
        if ((search != '') && (search.length > 1)) {
            $.ajax({
                type: "POST",
                url: 'search',
                dataType: "html",
                data: {'search': search},
                success: function (msg) {
                    $('#for-search-result').html(msg);
                }
            });
        }
    });

    $("#form-search").on('submit', function(e) {
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            dataType: "html",
            data: form.serialize(),
            success: processServerResponseSearch
        });
    });

    function processServerResponse(data) {
        let info = JSON.parse(data);

        if (info.error) {
            $('#message').text(info.error);
            $('#message').css('color', 'red');
        }else{
            $('#message').text(info.success);
            $('#message').css('color', 'green');
        }
    }

    function processServerResponseDelete(data) {
        let info = JSON.parse(data);

        if (info.error) {
            $('#message_del').text(info.error);
            $('#message_del').css('color', 'red');
        }else{
            $('#message_del').text(info.success);
            $('#message_del').css('color', 'green');
            $('.phone_number_search').val('');
        }
    }

    function processServerResponseSearch(data) {
        let info = JSON.parse(data);
        let text;

        if (info.error) {
            $('#message_search').text(info.error);
            $('#message_search').css('color', 'red');
        }else{
            text = 'Phone: ' + info.success.phone + '; Country Name: ' + info.success.country_name + '; Country Code: ' + info.success.country_code;
            $('#message_search').text(text);
            $('#message_search').css('color', 'green');
            $('.phone_number_search').val('');
        }
    }

});