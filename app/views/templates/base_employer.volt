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
    
	<div class="container">
		<div class="row">
		
			<div id="links">
				{% block search %}{% endblock %}
			</div>
			
			<div id="content" class="col-lg-10">
				{% block content %}{% endblock %}
			</div>
			
			<div id="content" class="col-lg-2">
				{% block bookmarks %}{% endblock %}
			</div>
			
		</div>
	</div>
	
	{{ partial("partials/footer_scripts") }}
   
</body>
</html>