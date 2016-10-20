<?php
class DBPantry {
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Adds a new food item to the database.
     * @param string $foodName the name of the food.
     * @param string $foodType the id corresponding to the food type.
     * @param string $expDate  the foods expiration date.
     * @return boolean true if the data was successfully inserted, false
     *                 otherwise.
     */
    function addFoodItem($foodName, $foodType, $expDate) {
        $stmt = $this->conn->prepare("INSERT INTO pantry (name, food_type, expiration_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $foodName, $foodType, $expDate);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    /**
     * Deletes a food item with a given id.
     * @param  string $id the id of the food to be deleted.
     * @return json|boolean returns the row of data deleted in the database if
     *                      successful, or false otherwise.
     */
    function deleteFoodItem($id) {
        $deleted_data = $this->getFoodById($id);
        $stmt = $this->conn->prepare("DELETE FROM pantry WHERE id=?");
        $stmt->bind_param("s", $id);

        if ($stmt->execute()) {
            return $deleted_data;
        }

        return false;
    }

    /**
     * Gets all food items from the pantry table.
     * @return json|boolean returns a json encoded object, or false if the
     *                      table is empty.
     */
    function getAllFoods() {
        $sql = "SELECT pantry.name AS name, pantry.expiration_date AS expiration_date, food_type.name AS food_type, pantry.id AS id FROM pantry LEFT JOIN food_type ON pantry.food_type = food_type.id ORDER BY food_type";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return false;
    }

    /**
     * Gets every row from the food_type table.
     * @return json|boolean returns a json encoded object, or false if the
     *                      table is empty.
     */
    function getAllFoodTypes() {
        $sql = "SELECT * FROM food_type";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return false;
    }

    /**
     * Gets every row from the pantry table with a given food_type id.
     * @param  string $id   food_type id
     * @return json|boolean returns a json encoded object, or false if the
     *                          query doesn't return a result.
     */
    function getFoodByFoodType($id) {
        $stmt = $this->conn->prepare("SELECT name, expiration_date, id FROM pantry WHERE food_type=?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return false;
    }

    /**
     * Gets a single food item corresponding to a specific id.
     * @param  string $id the food item unique identifier.
     * @return json|boolean returns a json encoded object, or false if the
     *                      query doesn't return a result.
     */
    function getFoodById($id) {
        $stmt = $this->conn->prepare("SELECT name, expiration_date, id FROM pantry WHERE id=?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return false;
    }
}
?>
