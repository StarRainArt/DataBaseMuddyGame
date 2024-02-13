<?php require_once 'helper_functions.php'; ?>
<?php
    /**
    * generic commands with no specific gameplay elements
    */
    function help($arguments, $puppet, $conn) {
        /**
         * returns all commands available to the player
         */
        echo "type commands as <command> <paramaters>\n";
        echo "f.i. 'look dex'\n";
        echo "available commands:\n";

        global $text_to_magic_converter; // use 'global' at your own risk!

        echo implode(', ', array_keys($text_to_magic_converter)) . "\n";
    }

    function quit($arguments, $puppet, $conn) {
        /**
         * game shutdown
         */
        echo "have a nice day!\n";
        exit();
    }
?>