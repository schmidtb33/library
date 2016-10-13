$( document ).ready(function() {
    var userId = null;
    var csrfToken =  "'.Yii::app()->request->csrfToken.'";

    /**
     * get book list and fill options
     * @param {Number} userId - id of user
     */
    $(".addBook").on("click", function () {
        userId = $(this).attr('id')
        var btn = $(this);
        showLoading();
        $.ajax({
            url: Yii.app.createUrl('BookWidget/getList'),
            type: 'POST',
            dataType: "html",
            data: {
                YII_CSRF_TOKEN:csrfToken
            },
            success: function(data,textStatus, jqXHE){
                hideLoading();
                $('#bookList').html(data);
            },
            error: function (XMLHttpRequest, textStatus, exception) {
                hideLoading();
            },
            async: true
        });

        var bookList = $("#bookList");
        // show under clicked add button
        $('#bookList').css({
            position: 'absolute',
            top: btn.offset().top,
            left: btn.offset().left  - 260
        }).show();
        //se.show();
        bookList[0].size = 5;
    });

    /**
     * add selected book to user
     * @param {Number} id - id of book to lend
     * @param {Number} userId - id of user
     */
    $("#bookList").on("click", function () {
        var se = $(this);
        var bookId = $(this).find(":selected").val();
        $.ajax({
            url: Yii.app.createUrl('BookWidget/add'),
            type: 'POST',
            dataType: "html",
            data: {
                YII_CSRF_TOKEN:csrfToken,
                id: bookId,
                userId: userId,
            },
            success: function(data,textStatus, jqXHE){
                hideLoading();
                location.reload();
                // todo: only refresh current book list of user
            },
            error: function (XMLHttpRequest, textStatus, exception) {
                hideLoading();
                // show error message
                alert('You cannot lend the book');
            },
            async: true
        });
        se.hide();
    });

    /**
     * remove book from user
     * @param {Number} id - id of bookHasUser to remove
     */
    $(".removeBook").on("click", function () {
        id = $(this).attr('id')

        showLoading();
        $.ajax({
            url: Yii.app.createUrl('BookWidget/remove'),
            type: 'POST',
            dataType: "html",
            data: {
                YII_CSRF_TOKEN:csrfToken,
                id: id,
            },
            success: function(data,textStatus, jqXHE){
                hideLoading();
                location.reload();
                // todo: only refresh current book list of user
            },
            error: function (XMLHttpRequest, textStatus, exception) {
                hideLoading();
                alert('Book could not be removed')
            },
            async: true
        });
    });

});

/**
 * show loading circle
 */
function showLoading()
{
    $('#loading-indicator').show();
}

/**
 * hide loading circle
 */
function hideLoading()
{
    $('#loading-indicator').hide();
}