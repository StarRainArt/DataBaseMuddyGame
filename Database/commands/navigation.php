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

            $sql = "SELECT name FROM creatures WHERE room = :room_node";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':room_node', $current_room_id);
            $stmt->execute();
            $creature = $stmt->fetch(PDO::FETCH_ASSOC);

            // echo "You are {$room_data['location']}.\n{$room_data['description']}.\nYou see a {$creature['name']}\n";

            if (!empty($creature)) {
                echo "You are \033[94m{$room_data['location']}\033[0m.\n{$room_data['description']}.\nYou see a \033[93m{$creature['name']}\033[0m\n";
            }
            else {
                echo "You are \033[94m{$room_data['location']}\033[0m.\n{$room_data['description']}.\n";
            }

            if ($current_room_id == 12) {
                echo "You awaken after a little while and slowly your vision clears. It seems you have come through your trip unscathed.\n\n\033[92mTHE END!\033[0m\n\n";
                exit();
            }
            elseif ($current_room_id == 3) {
                echo "Watch out! If you go \033[91msouth\033[0m, you'll step into the river!\n";
            }
            elseif ($current_room_id == 9) {
                echo "Watch out! If you go \033[91north\033[0m, you'll step into the river!\n";
            }
        }
        else {
            echo "You can't go here \n";
        };
    }
?>