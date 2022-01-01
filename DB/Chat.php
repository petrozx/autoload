<?
class Chat
{

    // public function sendHeaders($headersText, $newSocket, $host, $port) {
    //     $headers = [];
    //     $tmpLine = explode("\r\n", $headersText);
    //     foreach($tmpLine as $line) {
    //         $line = trim($line);
    //         $prepare = explode(":", $line);
    //         $headers[$prepare[1]] = $prepare[2];
    //     }
    //     $key = $headers['Sec-WebSocket-key'];
    //     $sKey = base64_encode(pack('H*',sha1($key.'petroz.myjino.ru')));
    //     $strHeader = "
    //                 HTTP/1.1 101 Switching Protocols \r\n" .
    //                 "Upgrade: websocket\r\n" .
    //                 "Connection: Upgrade\r\n" .
    //                 "WebSocket-Origin: $host\r\n" .
    //                 "WebSocket-Localhost: ws://$host:$port/chat/websock\r\n" .
    //                 "Sec-WebSocket-Accept: $sKey\r\n\r\n";

    //     socket_write($newSocket, $strHeader, strlen($strHeader));
    // }


}