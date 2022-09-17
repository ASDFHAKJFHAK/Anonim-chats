<?php


namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;

session_start();
// require ('profile.php');
require '../vendor/autoload.php';
// require('function.php');


class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $data) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n", $from->resourceId, $data, $numRecv, $numRecv == 1 ? '' : 's');
        
        $dataFromBd = json_decode($data);
        $dataFromBd->time = date("Y-m-d H:i:s");
        $connection = mysqli_connect('localhost', 'root');
        $select = mysqli_select_db($connection, 'chat');
        mysqli_query($connection, "INSERT INTO `message` (user_id, chat_id, content, time) VALUES ('$dataFromBd->user_id' , '$dataFromBd->chat_id' , '$dataFromBd->msg' ,'$dataFromBd->time' )");

        foreach ($this->clients as $client) {

            // if ($from !== $client) {
                // The sender is not the receiver, send to each client connected

            $client->send(json_encode($dataFromBd));

            // }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8656
);

$server->run();