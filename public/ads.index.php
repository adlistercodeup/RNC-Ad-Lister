

$limit = 4;

$pageLimiter = getPagination($dbc, $limit);

// prevents users from breaking page
$page = sanitizePages($pageLimiter);

// set pagination for page
$offseter = ($page * $limit) - $limit; 

$results = getResults ($dbc, $limit, $offseter);

return array(
	'results' => $results,
	'page' => $page,
	'pageLimiter' => $pageLimiter,
	'errors' => $errors
	);


