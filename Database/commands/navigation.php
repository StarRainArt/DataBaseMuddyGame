<?php require_once 'helper_functions.php'; ?>
<?php
    function navigate($arguments, $puppet, $conn) {
        /**
         * move character over nodes to other rooms
         * the first argument is the direction (node name)
         */
        $player_name= "teacher";

        $sql = "SELECT current_room FROM user WHERE name = :player_name";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':player_name', $player_name);
        $stmt->execute();
        $current_room_id = $stmt->fetchColumn();

        $sql = "SELECT node FROM room WHERE node = :current_room_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':current_room_id', $current_room_id);
        $stmt->execute();
        $room_node = $stmt->fetchColumn();

        $sql = "SELECT direction FROM room_directions WHERE current_room = :room_node";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':room_node', $room_node);
        $stmt->execute();
        $directions_data = $stmt->fetchAll(PDO::FETCH_COLUMN);


        
        if (in_array($arguments[0], $directions_data)){
            $dest_arg = $arguments[0];

            $sql = "SELECT destination FROM room_directions WHERE current_room = :room_node AND direction = :dest_arg";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':dest_arg', $dest_arg);
            $stmt->bindParam(':room_node', $room_node);
            $stmt->execute();
            // $direction_destination = $stmt->fetchColumn();
            $direction_destination = $stmt->fetch(PDO::FETCH_ASSOC);

            $destination = $direction_destination['destination'];

            $player_name = "teacher";

            $sql = "UPDATE user SET current_room = :destination WHERE name = :player_name";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':player_name', $player_name);
            $stmt->bindParam(':destination', $destination);
            $stmt->execute();

            $sql = "SELECT current_room FROM user WHERE name = :player_name";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':player_name', $player_name);
            $stmt->execute();
            $current_room_id = $stmt->fetchColumn();

            // Fetch the name and description of the current room from the room table
            $sql = "SELECT location, description FROM room WHERE node = :current_room_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':current_room_id', $current_room_id);
            $stmt->execute();
            $room_data = $stmt->fetch(PDO::FETCH_ASSOC);

            echo "You are {$room_data['location']}.\n{$room_data['description']}.\n";
        }
        else {
            echo "You can't go here \n";
        };
    }
?>