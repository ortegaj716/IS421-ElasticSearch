<?php

$searchTerm = $_POST['tweetSearch'];

$a = array(

  'query' => array(
  
    'constant_score' => array(
    
	  'filter' => array(
	  
	    'term' => array(
	      'text' => $searchTerm,
		),
	  
	  ),
	
	),
  
  ),
  
);

$json = json_encode($a);                                                                              
		 
$ch = curl_init('http://localhost:9200/stream/tweets/_search?size=2000');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($json))                                                                       
);                                                                                                                   
		 
$result = curl_exec($ch);

$tweets = json_decode($result,1);

//Print a table

print '<h1>Returned Tweets</h1>';

print '<p>Searching for keyword "' . $searchTerm . '". To filter search results to a certain user, click their username.</p>';

print '<table border = "1">
<tr>
<th>Username</th>
<th>Tweet</th>
</tr>
';

foreach($tweets['hits']['hits'] as $key => $value){

	$link = sprintf('<a href="%s">%s</a>','filterTweets.php?searchTerm=' . $searchTerm . '&user=' . $value['_source']['user']['screen_name'],$value['_source']['user']['screen_name']);

	print '<tr>';
	print '<td>' . $link . '</td>';
	print '<td>' . $value['_source']['text'] . '</td>';
	print '</tr>';
	
}

//print $tweets['hits']['hits'][0]['_source']['text'];

print '</table>';

?>