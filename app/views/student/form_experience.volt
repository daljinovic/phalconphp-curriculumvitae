{% extends "templates/base_student.volt" %}

{% block title %} MyCV - Experience {% endblock %}


{% block navigation %}

	{{ partial("partials/student_partials/student_navbar") }}

{% endblock %}


{% block links %}
	
	{{ partial("partials/student_partials/student_links") }}
	
{% endblock %}



{% block content %}
	
	<section class="content-section">
	
		{{ partial("partials/flash", ['flashSession' : flashSession|default(null)]) }}
			
		<h3>Experience information</h3>
		<hr>
		
		{% for experience in experiences %}
		
		<div id="exp{{ experience.id }}" class="form-horizontal">

			<h4><a href="#{{ experience.id }}" data-toggle="collapse"> {{ experience.institution_name }} </a></h4>
			
			<a href="{{ url('student/mycv/experience/delete/' ~experience.id) }}" > delete </a>
			
			<form class="collapse" id="{{ experience.id }}" method="post" action="{{ url('student/mycv/experience/edit/' ~experience.id) }}" >
			
				<label for="institution_name">Institution name</label>
				{{ text_field("institution_name", "value": experience.institution_name, "required": true, "class": "form-control") }}
				
				<label for="city">City</label>
				{{ text_field("city", "value": experience.city, "required": true, "class": "form-control") }}
				
				<label for="country">Country</label>
				{{ text_field("country", "value": experience.country, "required": true, "class": "form-control") }}
				
				
				<label for="position">Position</label>
				{{ text_field("position", "value": experience.position, "required": true, "class": "form-control") }}
				
				<label for="functions">Functions or job description</label>
				{{ text_area("functions", "value": experience.functions, "rows": 4, "cols": 50, "class": "form-control", "placeholder": "not required") }}
				

				<label for="duration_from">Date from</label>
				{{ text_field("duration_from" ~experience.id, "value": experience.duration_from, "required": true, "class": "form-control datepicker") }}		
				
				<label for="duration_to">Date to</label>
				{{ text_field("duration_to" ~experience.id, "value": experience.duration_to, "class": "form-control datepicker", "placeholder": "not required") }}
			
				
				{{ submit_button("Save",  "id": "save", "class": "btn btn-lg btn-primary btn-block") }}
				
				<hr>
			</form>	
			
		</div>
		
		<hr>

		{% endfor %}
		
		
		<div id="new_exp" class="form-horizontal">
			<a href="#new" data-toggle="collapse"><u> Add experience </u></a>
		
			<form class="collapse" id="new" method="post" action="{{ url('student/mycv/experience/save') }}" >
			
				<label for="institution_name">Institution name</label>
				{{ text_field("institution_name", "required": true, "class": "form-control") }}
				
				<label for="city">City</label>
				{{ text_field("city", "required": true, "class": "form-control") }}
				
				<label for="country">Country</label>
				{{ text_field("country", "required": true, "class": "form-control") }}
				
				
				<label for="position">Position</label>
				{{ text_field("position", "required": true, "class": "form-control") }}
				
				<label for="functions">Functions or job description</label>
				{{ text_area("functions", "rows": 4, "cols": 50, "class": "form-control", "placeholder": "not required") }}
				

				<label for="duration_from">Date from</label>
				{{ text_field("duration_from", "required": true, "class": "form-control datepicker") }}
				
				<label for="duration_to">Date to</label>
				{{ text_field("duration_to", "class": "form-control datepicker", "placeholder": "not required") }}		
			
				
				{{ submit_button("Save",  "id": "save", "class": "btn btn-lg btn-primary btn-block") }}
				
				<hr>
			</form>	
		</div>
		
	</section>

{% endblock %}
