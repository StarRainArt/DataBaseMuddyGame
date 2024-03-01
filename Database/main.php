<?php
    /** 
     * the game starts with pretty text while the game
     * connects to the database and imports the commands
     * 
     * if you like boring you can remove all but the two 'require_once'
     * but you wouldn't dare to be boring, right?
     * 
     * want to use cool colors yourself? https://en.wikipedia.org/wiki/ANSI_escape_code#Colors
     * (ESC = \033) "\033[91m" means change to color 91, to turn back to white "\033[0m
     */

    echo "\033c"; // clear screen so we start our game from the top of the screen
    echo "\033[91msetting up the the best game ever!\033[0m\n";
    
    echo "trying to connect to the database...";
    
    require_once 'connect_to_database.php';

    echo "importing commands from the commands.php file...";
    
    require_once 'commands/generic.php';
    require_once 'commands/navigation.php';
    require_once 'commands/senses.php';
    
    echo "\033[32mdone!\033[0m\n\n";

    $name_of_my_game = "fluffy world";
    echo "\033[96mWelcome to $name_of_my_game, start typing and enjoy!\033[0m\n";
    echo "type 'help' for help or 'look' to have a look around\n\n";

    /**
     * *spoiler alert*
     * games are code and 'stuff happening and creating magic' is just
     * functions being called.....
     * 
     * But, don't be sad, because:
     *   if the magic and fun come from the functions....
     *   and functions are written by developers....
     *   developers are the people creating the fun and magic....
     *   which makes the job as a developer the best job in the world!
     * 
     * In this game we get 'plain text' from the player
     * which must be turned into a function which (when executed)
     * should make the magic happen. 
     * 
     * written in one sentence:
     *     text => function == magic happening, wow!
     * 
     * this is done by the command_parser
     * it takes the input (plain text) given by the player
     * and transforms it into actual commands (functions) that will make
     * the game come alive and the magic happen
     * 
     * read all about it in the command_parser.php file, but read on first
     */
    require_once 'command_parser.php';

    /**
     * so, if our game is 'just':
     *     "text => function == magic happening, wow!"
     * 
     * we only need a "text => function" solution in PHP....
     * and thank you associative array!
     * 
     * you probably know that if you have an array like
     *     $best_array_ever = array('ping' => 'pong')
     * and you ask it for the value of 'ping'
     *     $best_array_ever['ping']
     * you get
     *     'pong'
     * 
     * but did you know that when 'pong' is also a function in your code
     * you can actualy execute the function?
     *     $best_array_ever['ping']()
     * will execute the function pong, wow!!
     * 
     * We have just created an instant "text to magic converter"!!
     * 
     * So, you want the text 'sing' to call the function 'a_song'?
     *     add  'sing' => 'a_song'  to the text_to_magic_converter
     *     write the function a_song in commands.php and you are good to go.
     * 
     * disable a command? remove it from the text_to_magic_converter
     */
    $text_to_magic_converter = array(
        'help' => 'help',
        'quit' => 'quit',
        'north' => 'navigate',
        'east' => 'navigate',
        'south' => 'navigate',
        'west' => 'navigate',
        'look' => 'look');

    /**
     * the final step before the game starts is you!
     * you will play one of the many characters in the game
     * this way you can be any hero you like, play as a rabbit or elf
     * 
     * this also allows the game te be scaled into a multiplayer game
     * a multi-user dungeon -->  'mud'
     * https://en.wikipedia.org/wiki/Multi-user_dungeon
     * 
     * to know which character you are playing, we will fetch it
     * from the database
     * to change to another character, switch user of change the puppet
     * you are connected to in the database.
     */
    $my_username = 'teacher'; // you can also use 'student' or add your own
    $starter_room = 1;

    $sql = "SELECT puppet FROM user WHERE name = :player_name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':player_name', $my_username);
    $stmt->execute();
    $puppet = $stmt->fetch(PDO::FETCH_ASSOC)['puppet'];

    echo "you are playing puppet number {$puppet}\n";

    $sql = "SELECT location FROM room WHERE node = :starter_room";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':starter_room', $starter_room);
    $stmt->execute();
    $room = $stmt->fetch(PDO::FETCH_ASSOC)['location'];

    echo "you are in room {$room}\n";

    // $sql = "UPDATE being SET current_room=:first_room WHERE id=1";
    // $stmt = $conn->prepare($sql);
    // $stmt->bindParam(':first_room', $starter_room);
    // $stmt->execute();
    // $current_room = $stmt->fetch(PDO::FETCH_ASSOC)['current_room'];

while (true) {
    /**
     * this loop is the actual game, 2 lines of code....
     * 1. get input from the user
     * 2. hand it over to the command_parser
     * and repeat....
     * 
     * note that command_parser takes multiple arguments
     * including the puppet so the code knows who is playing
     */
    $raw_command = readline(">");
    command_parser(trim($raw_command), $puppet, $text_to_magic_converter, $conn);
};
?>