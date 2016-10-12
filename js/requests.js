function populateFoods(json) {
    for (var i = 0; i < json.length; i++) {
        for (var prop in json) {
            console.log(prop + ' ' + json[prop]);
        }
    }
}

function getFood(id) {
    console.log(id);
    $.ajax({
        type: 'POST',
        url: '/db/ajaxRequests.php',
        data: {
            request: 'getFoodById',
            id: id
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
        },
        error: function(xhr, opt, err) {
            console.log(xhr);
            console.log(opt);
            console.log(err);
        }
    })
}
