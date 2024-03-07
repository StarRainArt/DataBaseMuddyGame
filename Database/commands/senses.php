<?php require_once 'helper_functions.php'; ?>
<?php
   function look_current_room($arguments, $puppet, $conn) {
   
         $player_name = 'teacher';

         // Fetch the current room ID for the player
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
         
         echo "You are in room {$room_data['location']}. {$room_data['description']}\n";
         
         
         }
   

?>