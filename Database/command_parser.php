<?php
    function command_parser($raw_command, $puppet, $command_to_function_list, $conn) {
        /**
         * the user input ($raw_command) is parsed into two variables
         *    $arguments : a list containing the exploded text
         *    $command   : the element of the $arguments
         * 
         * example: 'pet the cute little rabbit'
         *    $arguments : ['pet', 'the', 'cute', 'little', 'rabbit']
         *    $commmand  : 'pet'
         * 
         * getting the function connected to the $command value:
         *    $command_to_function_list[$command]
         * which we can execute at the same time by adding '()'
         *     $command_to_function_list[$command]()
         * for the function to understand the context (which animal to pet),
         * the $arguments is passed as an argument
         *     $command_to_function_list[$command]($arguments)
         * 
         * it is up to the function to use or not use the $arguments but this
         * might be useful for the function to f.i. determine which animal to pet
         * 
         * the rest of the code is added to handle wrong or empty user input
         * 
         * finaly the database connection is passed to the command function so
         * it can access the database. Not as elegant as in an OOP environment
         * but it will do for now
         */
        if ($raw_command === "") {
            // ignore empty input
            return;
        }
        $arguments = explode(" ", $raw_command);
        $command = $arguments[0];
        
        if (isset($command_to_function_list[$raw_command])) {
            $command_function = $command_to_function_list[$raw_command];
            $command_function($arguments, $puppet, $conn);
        }
        // Check if the command is a two-word command
        elseif (count($arguments) > 1) {
            $two_word_command = $arguments[0] . ' ' . $arguments[1];
            if (isset($command_to_function_list[$two_word_command])) {
                $command_function = $command_to_function_list[$two_word_command];
                array_shift($arguments); // Remove the first word
                array_shift($arguments); // Remove the second word
                $command_function($arguments, $puppet, $conn);
            } else {
                echo "I don't understand what you want me to do.\n";
            }
        }
        // Handle invalid commands
        else {
            echo "I don't understand what you want me to do.\n";
        }
    }
?>