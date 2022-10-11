<?php


namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;

require '../vendor/autoload.php';


class Chat implements MessageComponentInterface {
    protected $clients;

    // комнаты это двумерный масив где первый это id чата а второй список подключенных юзеров
    protected $rooms;
    // это список юзеров с их id и номером комноты в которой они находяться
    protected $users;

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
        // Этот блок срабатывает при открытии соединения
        if (isset($dataFromBd->newRoom)) {
            $this->rooms[$dataFromBd->newRoom][$from->resourceId] = $from;
            $this->users[$from->resourceId] = $dataFromBd->newRoom;
        }else{

            // а этот при отправке сообшений
            $dataFromBd->time = date("Y-m-d H:i:s");
            $connection = mysqli_connect('localhost', 'root');
            $select = mysqli_select_db($connection, 'chat');

            mysqli_query($connection, "INSERT INTO `message` (user_id, chat_id, content, time) VALUES ('$dataFromBd->user_id' , '$dataFromBd->chat_id' , '$dataFromBd->msg' ,'$dataFromBd->time' )");

            $room = $this->users[$from->resourceId];

            foreach($this->rooms[$room] as $client){
                $client->send(json_encode($dataFromBd));
            }
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