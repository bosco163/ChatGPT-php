<?php
// 获取前端发送的数据
$data = json_decode(file_get_contents('php://input'), true);

// 设置OpenAI API请求的相关信息
$apiUrl = 'https://api.openai-proxy.com/v1/chat/completions';
$headers = [
    'Content-Type: application/json',
    'Authorization: Bearer 您的API KEY', // 请替换为您的密钥，且务必通过安全方式存储
];

// 准备请求体，直接使用前端发送的聊天记录
$postData = [
    'model' => 'gpt-3.5-turbo', // 根据需要选择模型
    'messages' => $data['messages'],
];

// 初始化curl会话
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

// 执行curl请求
$response = curl_exec($ch);
curl_close($ch);

// 将响应发送回前端
header('Content-Type: application/json');
echo $response;
?>
