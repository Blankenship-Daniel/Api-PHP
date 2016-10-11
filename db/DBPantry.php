<?php
class DBPantry {
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Gets every row from the food_type database.
     * @return json | false returns a json encoded object, or false if the
     *                      table is empty.
     */
    function getAllFoodTypes() {
        $sql = "SELECT * FROM food_type";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return json_encode($result);
        }

        return false;
    }
}
?>
