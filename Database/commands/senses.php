<?php require_once 'helper_functions.php'; ?>
<?php
   function look($arguments, $puppet, $conn) {
      /**
       * describe what the character is looking at
      */

      // echo "It \033[91mlooks\033[0m like you need to code me first....\n";
      $sql = "SELECT current_room FROM being WHERE id=1";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $current_room = $stmt->fetch(PDO::FETCH_ASSOC)['current_room'];


      $sql = "SELECT desc FROM room WHERE node = :current_room";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':current_room', $current_room);
      $stmt->execute();
      $desc = $stmt->fetch(PDO::FETCH_ASSOC)['desc'];

      echo "It looks like you're in {$desc}\n";
   }
?>