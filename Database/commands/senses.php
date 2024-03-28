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

      $sql = "SELECT name FROM creatures WHERE room = :room_node";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':room_node', $current_room_id);
      $stmt->execute();
      $creature = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!empty($creature)) {
            echo "You are \033[94m{$room_data['location']}\033[0m.\n{$room_data['description']}.\nYou see a \033[93m{$creature['name']}\033[0m.\n";
      }
      else {
            echo "You are \033[94m{$room_data['location']}\033[0m.\n{$room_data['description']}.\n";
      }
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
            echo "You can go to the \033[91m{$direction_data['direction']}\033[0m.\n";
      }
}

function look_at($arguments, $puppet, $conn) {
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

      $sql = "SELECT description FROM creatures WHERE room = :room_node";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':room_node', $room_node);
      $stmt->execute();
      $creature = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!empty($creature)) {
            echo "{$creature['description']}\n";
      }
      else {
            echo "There is no creature here.\n";
      }
}

function talk_to($arguments, $puppet, $conn) {
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

      $sql = "SELECT name, dialogue FROM creatures WHERE room = :room_node";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':room_node', $room_node);
      $stmt->execute();
      $creature = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!empty($creature)) {
            echo "The \033[93m{$creature['name']}\033[0m says: '{$creature['dialogue']}'\n";
      }
      else {
            echo "There is no creature here.\n";
      }
}