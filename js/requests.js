(function() {
    function getFood(id) {
        $.ajax({
            type: 'POST',
            url: '/db/ajaxRequests.php',
            data: {
                request: 'getFoodById',
                id: id
            },
            dataType: 'JSON',
            success: function(data) {
                console.log(JSON.stringify(data));
            },
            error: function(xhr, opt, err) {
                console.log(err);
            }
        })
    }
})();
