<?php

class DAL
{
    public $servername = "localhost";
    public $username = "root";
    public $password = "";
    public $dbname = "carecommerce";

    // Private method to establish a database connection
    private function connect()
    {
        // Establish a connection to the database
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check if the connection was successful
        if ($conn->connect_error) {
            // Throw an exception if there is a connection error
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    public function getdata($sql)
    {
        // Get the database connection
        $conn = $this->connect();

        // Execute the SQL query
        $result = $conn->query($sql);

        // Check if the query was successful
        if (!$result) {
            // Throw an exception if there is an error with the query
            throw new Exception("Query failed: " . $conn->error);
        }

        // Fetch all results as an associative array
        $results = $result->fetch_all(MYSQLI_ASSOC);

        // Close the connection
        $conn->close();

        // Return the results
        return $results;
    }

    public function execute($sql)
    {
        // Get the database connection
        $conn = $this->connect();

        // Execute the SQL query
        $result = $conn->query($sql);

        // Check if the query was successful
        if ($result === false) {
            // Throw an exception if there is an error with the query
            throw new Exception($conn->error);
        } else {
            // Return the number of affected rows or the ID of the last inserted row
            if ($conn->insert_id !== 0) {
                return $conn->insert_id; // Return last inserted ID for INSERT queries
            } else {
                return $conn->affected_rows; // Return affected rows count for other queries
            }
        }
    }


    public function movemultiplefiles($image, $i, $folder)
    {
        $target_dir = "../assets/img/$folder/";
        $target_file = $target_dir . basename($image["name"][$i]); //p1.png //I guess $image is an array of photos for 1 item 

        $extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); //png

        $img_name = str_replace("." . $extension, "", basename($image["name"][$i])); //p1 // replace .png with empty string

        $count = 0;
        $image_name = $image["name"][$i]; // p1.png
        while (file_exists($target_file)) { // loop if array not empty
            $new_image = $img_name . "-" . $count . "." . $extension; //p1-0.png 
            $image_name = $new_image; // set new name
            $target_file = $target_dir . $new_image; // ../assets/img/p1-0.pngs

            $count++; // prevent infinite loop
        }
        $res = move_uploaded_file($image["tmp_name"][$i], $target_file); // upload the image in the folder
        return $image_name; //full name m3 ll extension
    }
    public function data($sql, $params = [])
    {
        $conn = $this->connect();

        // Check if there are parameters
        if (!empty($params)) {
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                throw new Exception($conn->error);
            }

            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);

            $result = $stmt->execute();

            if ($result === false) {
                throw new Exception($stmt->error);
            }

            $resultSet = $stmt->get_result();
            if ($resultSet === false) {
                // For non-SELECT queries like INSERT, UPDATE, DELETE
                $results = $result;
            } else {
                // For SELECT queries
                $results = $resultSet->fetch_all(MYSQLI_ASSOC);
            }

            $stmt->close();
        } else {
            // If there are no parameters, execute the query directly
            $result = $conn->query($sql);

            if ($result === false) {
                throw new Exception($conn->error);
            }

            if ($result instanceof mysqli_result) {
                // For SELECT queries
                $results = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                // For non-SELECT queries like INSERT, UPDATE, DELETE
                $results = $result;
            }
        }

        $conn->close();

        return $results;
    }
    public function executePrepared($sql, $params)
    {
        $conn = $this->connect();

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        if (!empty($params)) {
            $types = '';
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_double($param)) {
                    $types .= 'd';
                } elseif (is_string($param)) {
                    $types .= 's';
                } else {
                    $types .= 'b'; // blob and other types
                }
            }
            $stmt->bind_param($types, ...$params);
        }

        $result = $stmt->execute();

        if ($result === false) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $data = [];
        $meta = $stmt->result_metadata();
        if ($meta !== false) {
            $fields = [];
            $row = [];
            while ($field = $meta->fetch_field()) {
                $fields[] = &$row[$field->name];
            }
            call_user_func_array([$stmt, 'bind_result'], $fields);

            while ($stmt->fetch()) {
                $tempRow = [];
                foreach ($row as $key => $val) {
                    $tempRow[$key] = $val;
                }
                $data[] = $tempRow;
            }
        }

        $stmt->close();
        $conn->close();

        return $data;
    }

    public function executePreparedUPT($sql, $params)
    {
        $conn = $this->connect();

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        if (!empty($params)) {
            $types = '';
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_double($param)) {
                    $types .= 'd';
                } elseif (is_string($param)) {
                    $types .= 's';
                } else {
                    $types .= 'b'; // blob and other types
                }
            }
            $stmt->bind_param($types, ...$params);
        }

        $result = $stmt->execute();

        if ($result === false) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $data = [];
        $meta = $stmt->result_metadata();
        if ($meta !== false) {
            $fields = [];
            $row = [];
            while ($field = $meta->fetch_field()) {
                $fields[] = &$row[$field->name];
            }
            call_user_func_array([$stmt, 'bind_result'], $fields);

            while ($stmt->fetch()) {
                $tempRow = [];
                foreach ($row as $key => $val) {
                    $tempRow[$key] = $val;
                }
                $data[] = $tempRow;
            }
        }

        $stmt->close();
        $conn->close();

        return $data;
    }
    public function insertAndGetId($sql, $params)
    {
        $conn = $this->connect();

        // Prepare the SQL statement
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $conn->error);
        }

        // Bind parameters
        $types = str_repeat('s', count($params)); // Assuming all params are strings for simplicity
        $stmt->bind_param($types, ...$params);

        // Execute the statement
        if (!$stmt->execute()) {
            throw new Exception("Failed to execute statement: " . $stmt->error);
        }

        // Get the last inserted ID
        $lastId = $conn->insert_id;

        // Close the statement and connection
        $stmt->close();
        $conn->close();

        return $lastId;
    }
    public function escapeString($value)
    {
        // Get the database connection
        $conn = $this->connect();

        // Escape the string
        $escapedValue = $conn->real_escape_string($value);

        // Check if the escape was successful
        if ($escapedValue === false) {
            throw new Exception($conn->error);
        }

        return $escapedValue;
    }
}
