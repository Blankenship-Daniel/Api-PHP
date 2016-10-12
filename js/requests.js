function getFood(id) {
    console.log(id);
    $.ajax({
        type: 'POST',
        url: '/db/ajaxRequests.php',
        data: {
            request: 'getFoodById',
            id: id
        },
        dataType: 'html',
        success: function(data) {
            console.log(JSON.stringify(data));
        },
        error: function(xhr, opt, err) {
            console.log(xhr);
            console.log(opt);
            console.log(err);
        }
    })
}
