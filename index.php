<?php

$botToken = "7283566944:AAE79lc8xKaRJQp-pdwBKWsuoymujxFShfY";
$website = "https://api.telegram.org/bot" . $botToken;

$update = file_get_contents("php://input");
$update = json_decode($update, TRUE);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

function sendMessage($chatId, $text, $keyboard = null)
{
    global $website;

    $url = $website . "/sendMessage?chat_id=" . $chatId . "&text=" . urlencode($text);

    if ($keyboard) {
        $url .= "&reply_markup=" . json_encode($keyboard);
    }

    file_get_contents($url);
}

function getKeyboard($buttons)
{
    return [
        'keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
    ];
}

$mainMenu = getKeyboard([
    [["text" => "Aloqa"], ["text" => "Ijtimoiy tarmoqlar"]],
    [["text" => "Joylashuv"], ["text" => "Analiz qidirish"]]
]);

$backMenu = getKeyboard([
    [["text" => "Ortga"]]
]);

if ($message == "/start") {
    sendMessage($chatId, "Eng arzon narxlarda yuqori sifatli laboratoriya xizmatlarini taqdim etamiz!

    Aloqa uchun: +998912787878
    Batafsil ma'lumot saytda👇

    https://alabaratory.netlify.app/", $mainMenu);
}

elseif ($message == "Aloqa") {
    sendMessage($chatId, "+998912787878", $mainMenu);
} elseif ($message == "Ijtimoiy tarmoqlar") {
    sendMessage($chatId, "@Ijtimoiy tarmoqlar", $mainMenu);
} elseif ($message == "Joylashuv") {
    sendMessage($chatId, "lakatsiya", $mainMenu);
} elseif ($message == "Analiz qidirish") {
    sendMessage($chatId, "Analiz raqamini kiriting:", $backMenu);
} elseif ($message == "Ortga") {
    sendMessage($chatId, "Bosh menyu", $mainMenu);
}

elseif ($message == "a") {
    sendMessage($chatId, "1", $backMenu);
} elseif ($message == "b") {
    sendMessage($chatId, "2", $backMenu);
} elseif ($message == "c") {
    sendMessage($chatId, "3", $backMenu);
}
