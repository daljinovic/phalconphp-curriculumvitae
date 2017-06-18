<!DOCTYPE html>

<html lang="en">
<head>
	
	<title>
		{% block title %}{% endblock %}
	</title>

	{{ partial("partials/header_scripts") }}
	
</head>

<body>

	{% block navigation %}{% endblock %}
    
	{% block content %}{% endblock %}
   
</body>
</html>