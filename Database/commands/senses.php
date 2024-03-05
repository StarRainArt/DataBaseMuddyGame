<?php require_once 'helper_functions.php'; ?>
<?php
   function look($arguments, $puppet, $conn) {
      /**
       * describe what the character is looking at
       */
         $current_room = "3";

      // echo "It \033[91mlooks\033[0m like you need to code me first....\n";
         $sql = "SELECT description FROM room WHERE node = :current_room";
         $stmt = $conn->prepare($sql);
         $stmt -> bindParam(':current_room', $current_room, PDO::FETCH_ASSOC);
         $stmt->execute();
         $room_description = $stmt->fetchColumn();

         echo "You are in room {$current_room}. {$room_description}\n";

   }
?>