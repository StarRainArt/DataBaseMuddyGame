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

        if (isset($command_to_function_list[$command])) {
            // execute the command with the remaining user input
            // we hand the function the $arguments, the $puppet and the $conn
            $command_to_function_list[$command]($arguments, $puppet, $conn);
        } else {
            // handle invalid commands 
            echo "you want me to do what now?\n";
        }
    }
?>