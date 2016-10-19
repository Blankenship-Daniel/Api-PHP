function populateFoods(json) {
    var str = '';
    var foods = $('#foods');
    foods.html('');

    console.log(json);

    for (var i = 0; i < json.length; i++) {
        str += '<tr>';
        for (var prop in json[i]) {
            if (prop === 'id') {
                str += '<td><i onclick="deleteFoodItem(' +
                    json[i][prop] + ')" class="fa fa-minus-circle"></i></td>';
            } else {
                str += '<td>' + json[i][prop] + '</td>';
            }
        }
        str += '</tr>';
    }

    foods.append(str);
}

function getFood(id) {
    $.ajax({
        type: 'POST',
        url: '/db/ajaxRequests.php',
        data: {
            request: 'getFoodById',
            id: id
        },
        dataType: 'json',
        success: function(data) {
            populateFoods(data);
        },
        error: function(xhr, opt, err) {
            console.log(xhr);
            console.log(opt);
            console.log(err);
        }
    });
}

$(function() {
    getFood(2);
});
