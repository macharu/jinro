<?php
/**
 * Created by PhpStorm.
 * User: henrymasaflight
 * Date: 2014/11/15
 * Time: 16:09
 */


$cursor = '';

$cont = array();

$url = $_POST["url"];
$id = call_user_func('end', preg_split('@/@', $url, -1, PREG_SPLIT_NO_EMPTY));


$result = array(
    'villege' => array(
        'name' => '村人',
        'win' => 0,
        'all' => 0
    ),
    'knight' => array(
        'name' => '騎士',
        'win' => 0,
        'all' => 0
    ),
    'madman' => array(
        'name' => '狂人',
        'win' => 0,
        'all' => 0
    ),
    'uranai' => array(
        'name' => '占い師',
        'win' => 0,
        'all' => 0
    ),
    'reinou' => array(
        'name' => '霊能者',
        'win' => 0,
        'all' => 0
    ),
    'jinrou' => array(
        'name' => '人狼',
        'win' => 0,
        'all' => 0
    ),

);

function get_data($cursor = null,$id){

    $url = 'http://www.werewolfonline.net/command/getuserplayedvillages';

    $data = array(
        'status' => '1',
        'max' => '100',
        'user_id' => $id,
        'cursor' => $cursor

    );
    $headers = array(
        'User-Agent: My User Agent 1.0',    //ユーザエージェントの指定
        'Authorization: Basic '.base64_encode('user:pass'),//ベーシック認証
        'Content-Type: application/x-www-form-urlencoded',
        'Content-Length: '.strlen(http_build_query($data))
    );
    $options = array('http' => array(
        'method' => 'POST',
        'content' => http_build_query($data),
        'header' => implode("\r\n", $headers),
    ));
    $contents = @file_get_contents($url, false, stream_context_create($options));

    $contents = json_decode($contents, true);

    return $contents;
}

$data = get_data($cursor,$id);
$code = $data["returncode"];
$cursor = $data["cursor"];


if($code != 200){
    echo json_encode("error");
    
}else{
    
    $cont = array_merge($cont,$data["villages"]);
    
    while($code == 200){
    
        $data = get_data($cursor,$id);
        $code = $data["returncode"];
        if($code == 200){
            $cont = array_merge($cont,$data["villages"]);
        }
        if(array_key_exists("cursor",$data)){
	        $cursor = $data["cursor"];
        }
        

    }

    foreach($cont as $value){

        if($value["playerwin"] == 1){
            $point = 1;
        }else{
            $point = 0;
        };

        if($value["playerrole"] == 1){
            $result['villege']['all']++;
            $result['villege']['win'] = $result['villege']['win'] + $point;

        }

        if($value["playerrole"] == 2){
            $result['jinrou']['all']++;
            $result['jinrou']['win'] = $result['jinrou']['win'] + $point;
        }

        if($value["playerrole"] == 3){
            $result['uranai']['all']++;
            $result['uranai']['win'] = $result['uranai']['win'] + $point;
        }
        if($value["playerrole"] == 4){
            $result['madman']['all']++;
            $result['madman']['win'] = $result['madman']['win'] + $point;
        }
        if($value["playerrole"] == 5){
            $result['knight']['all']++;
            $result['knight']['win'] = $result['knight']['win'] + $point;
        }
        if($value["playerrole"] == 6){
            $result['reinou']['all']++;
            $result['reinou']['win'] = $result['reinou']['win'] + $point;
        }
    }

    $dataarr = array(
        "all" => count($cont),
        "detail" => ''
        );

    $dataarr["detail"] = $result;
    $dataarr = json_encode($dataarr);


    echo $dataarr;
    
}


    
    
    




