{% extends "templates/base_student.volt" %}

{% block title %} MyCV - Education {% endblock %}


{% block navigation %}

	{{ partial("partials/student_partials/student_navbar") }}

{% endblock %}


{% block links %}
	
	{{ partial("partials/student_partials/student_links") }}
	
{% endblock %}


{% block content %}	
	
	<section class="content-section">
		
		{{ partial("partials/flash", ['flashSession' : flashSession|default(null)]) }}
		
		<h3>Education information</h3>
		<hr>
		
		{% for education in educations %}
		
		<div id="edu{{ education.id }}" class="form-horizontal">
		
			<h4>{{ education.institution_name }}</h4>
			
			<a href="#{{ education.id }}" data-toggle="collapse" > details </a>
			<a href="{{ url('student/mycv/education/delete/' ~education.id) }}" > delete </a>
		
			<form class="collapse" id="{{ education.id }}" method="post" action="{{ url('student/mycv/education/edit/' ~education.id) }}" >
			
				<label for="institution_name">Institution name</label>
				{{ text_field("institution_name", "value": education.institution_name, "required": true, "class": "form-control") }}
				
				<label for="institution_name">Study</label>
				{{ text_field("study", "value": education.study, "required": true, "class": "form-control") }}
				
				<label for="city">City</label>
				{{ text_field("city", "value": education.city, "required": true, "class": "form-control") }}
				
				<label for="country">Country</label>
				{{ text_field("country", "value": education.country, "required": true, "class": "form-control") }}
				
				<label for="title">Title</label>
				{{ text_field("title", "value": education.title, "class": "form-control", "placeholder": "not required") }}
				
				
				<label for="science_field">Science field</label>				
				<select name="science_field" class="selectpicker form-control" data-style="btn-primary" required="true">
					<option value="@" disabled selected> Study science field </option>
					{% for i in science_domains %}
						<optgroup label="{{ i.name }}">
							{% for j in science_fields %}
								{% if j.scienceDomains.id == i.id %}
									{% if education.scienceFields.id == j.id %}
										<option value="{{ j.id }}" selected> {{ j.name }} </option>
									{% else %}
										<option value="{{ j.id }}"> {{ j.name }} </option>
									{% endif %}
								{% endif %}
							{% endfor %}
						</optgroup>
					{% endfor %}
				</select>
				
				
				<label for="duration_from{{ education.id}}">Date from</label>
				{{ text_field("duration_from" ~education.id, "value": education.duration_from, "required": true, "class": "form-control datepicker") }}	
				
				<label for="duration_to{{ education.id}}">Date to</label>
				{{ text_field("duration_to" ~education.id, "value": education.duration_to, "class": "form-control datepicker", "placeholder": "not required") }}
			
				
				{{ submit_button("Save",  "name": "save", "class": "btn btn-lg btn-primary btn-block") }}
				
				<hr>
			</form>
			
		</div>
		
		<hr>
		
		{% endfor %}
		
		
		
		<div id="new_edu" class="form-horizontal">		
			
			<a href="#new" data-toggle="collapse"><u> Add education </u></a>
			
			<form class="collapse" id="new" method="post" action="{{ url('student/mycv/education/save') }}" >
			
				<label for="institution_name">Institution name</label>
				{{ text_field("institution_name", "required": true, "class": "form-control") }}
				
				<label for="institution_name">Study</label>
				{{ text_field("study", "required": true, "class": "form-control") }}
				
				<label for="city">City</label>
				{{ text_field("city", "required": true, "class": "form-control") }}
				
				<label for="country">Country</label>
				{{ text_field("country", "required": true, "class": "form-control") }}
				
				<label for="title">Title</label>
				{{ text_field("title", "class": "form-control", "placeholder": "not required") }}
				
				
				<label for="science_field">Science field</label>
				
				<select name="science_field" class="selectpicker form-control" data-style="btn-primary" >
					<option value="@" disabled selected> Study science field </option>
					{% for i in science_domains %}
						<optgroup label="{{ i.name }}">
							{% for j in science_fields %}
								{% if j.scienceDomains.id == i.id %}
									<option value="{{ j.id }}"> {{ j.name }} </option>
								{% endif %}
							{% endfor %}
						</optgroup>
					{% endfor %}
				</select>
				
				
				<label for="duration_from">Date from</label>
				{{ text_field("duration_from", "required": true, "class": "form-control datepicker") }}	
				
				<label for="duration_to">Date to</label>
				{{ text_field("duration_to", "class": "form-control datepicker", "placeholder": "not required") }}
			
				
				{{ submit_button("Save",  "name": "save", "class": "btn btn-lg btn-primary btn-block") }}
				
				<hr>
			</form>
			
		</div>
		
	</section>

{% endblock %}

