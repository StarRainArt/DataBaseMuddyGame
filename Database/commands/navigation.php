<?php require_once 'helper_functions.php'; ?>
<?php
    function navigate($arguments, $puppet, $conn) {
        /**
         * move character over nodes to other rooms
         * the first argument is the direction (node name)
         */
            $direction = $arguments[0];

            switch($direction){
                case 'east':
                    echo "We're moving east! \n";
                    break;
                case 'north':
                    echo "We're moving North \n";
                    break;
                case 'south':
                    echo "We're moving South \n";
                    break;
                case 'west':
                    echo "We're moving West \n";
                    break;
                default:
                    echo "Where are we moving? \n";
            };
            //echo "we all want to go {$arguments[0]} but it just doesn't work until you code it..\n";
    }
?>