function addFood() {
    var foodName = $('#add_food_name').val();
    var foodType = $('#add_food_type').val();
    var expDate = $('#add_exp_date').val();

    $.ajax({
        type: 'POST',
        url: '/db/ajaxRequests.php',
        data: {
            request: 'addFoodItem',
            foodName: foodName,
            foodType: foodType,
            expDate: expDate
        },
        dataType: 'json',
        success: function(data) {
            getAllFoods();
        },
        error: function(xhr, opt, err) {
            console.log(xhr);
            console.log(opt);
            console.log(err);
        }
    });
}

function deleteFoodItem(id) {
    $.ajax({
        type: 'POST',
        url: '/db/ajaxRequests.php',
        data: {
            request: 'deleteFoodItem',
            id: id
        },
        dataType: 'json',
        success: function(data) {
            getAllFoods();
        },
        error: function(xhr, opt, err) {
            console.log(xhr);
            console.log(opt);
            console.log(err);
        }
    });
}

function populateFoods(json) {
    var str = '';
    var foods = $('#foods');
    foods.html('');

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

function getAllFoods() {
    $.ajax({
        type: 'POST',
        url: '/db/ajaxRequests.php',
        data: {
            request: 'getAllFoods'
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
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
    getAllFoods();
});
