{% extends "templates/base_student.volt" %}

{% block title %} MyCV - Personal {% endblock %}


{% block navigation %}

	{{ partial("partials/student_partials/student_navbar") }}

{% endblock %}


{% block links %}
	
	{{ partial("partials/student_partials/student_links") }}
	
{% endblock %}


{% block content %}

	<section class="content-section">
	
		{{ partial("partials/flash", ['flashSession' : flashSession|default(null)]) }}
			
		<h3>Personal information</h3>
		<p>Status: <i>( {{ user.status }} )</i></p>
		<p><i>First and last name are required to publish!</i></p>
		<hr>
		
		<form class="form-horizontal" method="post" action="{{ url('student/mycv/personal/save') }}" >
		
			<label for="fname">First name</label>
			{{ text_field("fname", "value": user.fname, "class": "form-control") }}
			
			<label for="lname">Last name</label>
			{{ text_field("lname", "value": user.lname, "class": "form-control") }}
			
			<label for="birth">Birth date</label>
			{{ text_field("birth", "value": user.birth, "class": "form-control datepicker") }}
			
			
			<label for="email">Email</label>
			{{ text_field("email", "value": user.email, "disabled": true, "class": "form-control") }}
			
			<label for="phone">Phone</label>
			{{ text_field("phone", "value": user.phone, "placeholder": "(+385) 91 123 4567", "class": "form-control") }}
			
			<label for="web">Web</label>
			{{ text_field("web", "value": user.web, "placeholder": "www.john.smith.uk", "class": "form-control") }}
			
			
			<label for="address">Address</label>
			{{ text_field("address", "value": user.address, "class": "form-control") }}
			
			<label for="city">City</label>
			{{ text_field("city", "value": user.cities.name|default(null), "class": "form-control") }}
			
			<label for="zip_code">ZIP code</label>			
			{{ text_field("zip_code", "value": user.cities.zip_code|default(null), "pattern": "[0-9]{5}", "class": "form-control") }}
			
			<label for="country">Country</label>
			{{ text_field("country", "value": user.cities.country|default(null), "class": "form-control") }}
			
			
			{{ submit_button("Save",  "name": "save", "class": "btn btn-lg btn-primary btn-block") }}
			
		</form>
		
	</section>

{% endblock %}