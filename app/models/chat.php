<?php
class Chat extends AppModel {
	var $name = 'Chat';
	public $useTable = 'chat';
	
/***
* Overridden PaginateCount Method for returning the count value *
* Its mainly used for paginations using group by clause *
***/

function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
$parameters = compact('conditions');

if (isset($extra['group']))
{
unset($extra['fields']);
$extra['fields'] = array('COUNT(id)');

//or

//$extra['fields'] = array('SUM(fieldname)');

//It depends on ur need or leave this. for ex. sum or count
}
else
{
unset($extra);
$extra = array();
}
$results = $this->find('all', array_merge($parameters, $extra));
return count($results);
}	



}

