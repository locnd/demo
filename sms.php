<?php  
    $user = '3ulf5odj'; 
    $password = 'FL0ZEJHC'; 
    $to = '84973050051'; 
    $from = 'cucgach'; 
    $text = 'Hello World'; 
         
    $content =  'action=sendsms'. 
                '&user='.rawurlencode($user). 
                '&password='.rawurlencode($password). 
                '&to='.rawurlencode($to). 
                '&from='.rawurlencode($from). 
                '&text='.rawurlencode($text); 
     
    $smsglobal_response = file_get_contents('http://www.smsglobal.com.au/http-api.php?'.$content);
    
    exit($smsglobal_response);
     
    //Sample Response 
    //OK: 0; Sent queued message ID: 04b4a8d4a5a02176 SMSGlobalMsgID:6613115713715266  
     
    $explode_response = explode('SMSGlobalMsgID:', $smsglobal_response); 
     
    if(count($explode_response) == 2) { //Message Success 
        $smsglobal_message_id = $explode_response[1]; 
         
        //SMSGlobal Message ID 
        echo $smsglobal_message_id; 
    } else { //Message Failed 
        echo 'Message Failed'.'<br />'; 
         
        //SMSGlobal Response 
        echo $smsglobal_response;     
    } 
?>