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

      echo "You are {$room_data['location']}.\n{$room_data['description']}.\n";
}

function look_directions($arguments, $puppet, $conn) {
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
      $directions_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($directions_data as $direction_data) {
            echo "You can go to the {$direction_data['direction']}\n";
      }
}
?>