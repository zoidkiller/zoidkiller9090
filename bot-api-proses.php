<?php

if (!defined('HS')) {
    die('Tidak boleh diakses langsung.');
}






/*

Contoh penggunaan :
~~~~~~~~~~~~~~~~~~~~~

Kirim Aksi
----------
(typing, upload_photo, record_video, upload_video, record_audio, upload_audio, upload_document, find_location) :

    sendApiAction($chatid);
    sendApiAction($chatid, 'upload_photo');


Kirim Pesan :
----------
    sendApiMsg($chatid, 'pesan');
    sendApiMsg($chatid, 'pesan *tebal*', false, 'Markdown');


Kirim Markup Keyboard :
----------
    $keyboard = [
        [ 'tombol 1', 'tombol 2' ],
        [ 'tombol 3', 'tombol 4' ],
        [ 'tombol 5' ]
    ];

    sendApiKeyboard($chatid, 'tombol pilihan', $keyboard);


Kirim Inline Keyboard
----------
    $inkeyboard = [
        [
            ['text'=>'tombol 1', 'callback_data' => 'data 1'],
            ['text'=>'tombol 2', 'callback_data' => 'data 2']
        ],
        [
            ['text'=>'tombol akhir', 'callback_data' => 'data akhir']
        ]
    ];

    sendApiKeyboard($chatid, 'tombol pilihan', $inkeyboard, true);


editMessageText
----------
    editMessageText($chatid, $message_id, $text, $inkeyboard, true);



Menyembunyikan keyboard :
----------
    sendApiHideKeyboard($chatid, 'keyboard off');


kirim sticker
----------

    sendApiSticker($chatid, 'BQADAgADUAADxKtoC8wBeZm11cjsAg')


Dan Lain-lain :-D
~~~~~~~~~~~~~~~~~~~~~

*/


function prosesApiMessage($sumber)
{
    $updateid = $sumber['update_id'];

   // if ($GLOBALS['debug']) mypre($sumber);

    if (isset($sumber['message'])) {
        $message = $sumber['message'];

        if (isset($message['text'])) {
            prosesPesanTeks($message);
        } elseif (isset($message['sticker'])) {
            prosesPesanSticker($message);
        } else {
            // gak di proses silakan dikembangkan sendiri
        }
    }

    if (isset($sumber['callback_query'])) {
        prosesCallBackQuery($sumber['callback_query']);
    }

    return $updateid;
}

function prosesPesanSticker($message)
{
    // if ($GLOBALS['debug']) mypre($message);
}

function prosesCallBackQuery($message)
{
    // if ($GLOBALS['debug']) mypre($message);

    $message_id = $message['message']['message_id'];
    $chatid = $message['message']['chat']['id'];
    $data = $message['data'];

    $inkeyboard = [
                [
                    ['text' => 'DOGE', 'callback_data' => '/doge'],
                    ['text' => 'ETH', 'callback_data' => '/eth'],
                ],
                [
                    ['text' => 'TRX', 'callback_data' => '/trx'],
                    ['text' => 'XLM', 'callback_data' => '/xlm'],
                ],
                [
                    ['text' => 'VOC', 'callback_data' => '/voc'],
                ],
            ];
            
           

    $text = '*'.date('H:i:s').'* data baru : '.$data;

    editMessageText($chatid, $message_id, $text, $inkeyboard, true);

    $messageupdate = $message['message'];
    $messageupdate['text'] = $data;

    prosesPesanTeks($messageupdate);
}



function prosesPesanTeks($message)
{
    // if ($GLOBALS['debug']) mypre($message);
    
    $pesan = $message['text'];
    $chatid = $message['chat']['id'];
    $fromid = $message['from']['id'];
    

        
    switch (true) {
           

        case $pesan == '📡ADMIN':
            sendApiAction($chatid);
            $text = "[ Developer]
Nama : zoidkiller9090
Telegram  : @zoidkiller9099
WhatsApp : 082144413022
Facebook  : https://www.facebook.com/sanusi.nagbejen
 Group    : https://t.me/GarapAirdrop99
 Channel1 : https://t.me/bersyukuralkhamdulillah/
 Channel2 : https://t.me/joinchat/AAAAAEQ-lMcnzdcjQi50Sw
======================";
             sendApiMsg($chatid, $text);
             break;

        case $pesan == '/menu':
            sendApiAction($chatid);
            $keyboard = [
                ['🏦BELI COIN'],
                ['📈RATE'],
                ['💰TOP UP', '🔔INFO'],
                ['📡ADMIN']
            ];
            sendApiKeyboard($chatid, 'SELAMAT BERBELANJA', $keyboard);
            break;
            
        case $pesan == '🏦BELI COIN':
            sendApiAction($chatid);
            $inkeyboard = [
                [
                    ['text' => 'DOGE', 'callback_data' => '/doge'],
                    ['text' => 'ETH', 'callback_data' => '/eth'],
                ],
                [
                    ['text' => 'TRX', 'callback_data' => '/trx'],
                    ['text' => 'XLM', 'callback_data' => '/xlm'],
                ],
                [
                    ['text' => 'VOC', 'callback_data' => '/voc'],
                ],
            ];
            sendApiKeyboard($chatid, 'SILAHKAN PILIH YANG MAU DI BELI', $inkeyboard, true);
            break;


        case $pesan == '/start';
sendApiAction($chatid);
$keyboard = [
                ['text' =>'Nomor Hp','request_contact' => true,'callback_data' => '/step2'],
            ];
            sendApiKeyboard($chatid, '🔻 STEP1
 [ Submit Contact ]', $keyboard);
            break;
            
            case $pesan = '/step2';
sendApiAction($chatid);
$keyboard = [
                ['text' =>'Location','request_location' => true,'callback_data' => '/menu']
            ];
            sendApiKeyboard($chatid, '🔻 STEP2
 [ Submit location ]', $keyboard);
            break;
            


    }
}
