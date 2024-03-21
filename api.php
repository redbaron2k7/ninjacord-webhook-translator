<?php
$incomingWebhookData = json_decode(file_get_contents('php://input'), true);

$discordWebhookUrl = 'YOUR_WEBHOOK_URL'; // Discord webhook URL
$avatarUrl = "YOUR_AVATAR_URL"; // The image URL that will display as the profile picture for the webhook
$rmmUrl = "https://app.rmmservice.com/#/deviceDashboard/{$incomingWebhookData['deviceId']}/overview"; // Your RMM Panel URL (only replace app.rmmservice.com part dont replace anything after)
$enableCriticalAlert = TRUE; // Enables an @everyone message if a critical event occurs
$alertMessage = "@everyone - A critical event has occured" // If Critical alerts are enabled, this is the message it will send along with the embed.

// Handle invalid JSON
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo 'Invalid JSON';
    exit();
}

// Map of severity to embed colors
$severityColorMap = [
    'CRITICAL' => 0xFF0000, 
    'MAJOR'    => 0xFFA500, 
    'MODERATE' => 0xFFFF00, 
    'MINOR'    => 0x00FF00,
    'NONE'     => 0x00FF00, // Default color
];

// Determine severity and embed color
$severity = strtoupper($incomingWebhookData['severity']);
$embedColor = isset($severityColorMap[$severity]) ? $severityColorMap[$severity] : 0x00FF00;

// Initialize content
$content = '';

// Define embed fields
$fields = [
    [
        "name" => "Type",
        "value" => $incomingWebhookData['type'],
        "inline" => true
    ],
    [
        "name" => "Status",
        "value" => $incomingWebhookData['status'],
        "inline" => true
    ],
    [
        "name" => "Severity",
        "value" => ucfirst(strtolower($incomingWebhookData['severity'])),
        "inline" => true
    ],
    [
        "name" => "Priority",
        "value" => ucfirst(strtolower($incomingWebhookData['priority'])),
        "inline" => true
    ],
    [
        "name" => "Message",
        "value" => $incomingWebhookData['message'],
        "inline" => false
    ]
];

// Add device dashboard URL if available
if (isset($incomingWebhookData['deviceId']) && !empty($incomingWebhookData['deviceId'])) {
    $deviceDashboardUrl = $rmmUrl;
    $fields[] = [
        "name" => "Device Dashboard",
        "value" => "[View Dashboard]($deviceDashboardUrl)",
        "inline" => false
    ];
}

// Set content for critical alerts
if ($severity === 'CRITICAL' && $enableCriticalAlert == true) {
    $content = $alertMessage;
}

// Construct Discord embed
$discordEmbed = [
    "content" => $content,
    "username" => "Notification Bot",
    "avatar_url" => "$avatarUrl",
    "embeds" => [
        [
            "color" => $embedColor,
            "fields" => $fields,
            "footer" => [
                "text" => "Your Service Name - Made by redbaron2k7",
                "icon_url" => "$avatarUrl"
            ],
            "timestamp" => date('c', $incomingWebhookData['activityTime'])
        ]
    ]
];

// Encode data for Discord webhook
$discordWebhookData = json_encode($discordEmbed);

// Send data to Discord webhook
$ch = curl_init($discordWebhookUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $discordWebhookData);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);

// Handle response
if ($response === false) {
    http_response_code(500);
    echo 'Error in sending to Discord';
} else {
    http_response_code(200);
    echo 'Sent to Discord successfully';
}

curl_close($ch);
?>
