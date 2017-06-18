{% extends "templates/base_student.volt" %}

{% block title %} MyCV - Skills {% endblock %}


{% block navigation %}

	{{ partial("partials/student_partials/student_navbar") }}

{% endblock %}


{% block links %}
	
	{{ partial("partials/student_partials/student_links") }}
	
{% endblock %}


{% block content %}

	<section class="content-section">
			
		{{ partial("partials/flash", ['flashSession' : flashSession|default(null)]) }}
		
		<h3>Skills information</h3>
		<hr>
		
		<form class="form-horizontal" method="post" action="{{ url('student/mycv/skills/save') }}" >
		
			<label for="language">Native language</label>
			{{ text_field("language", "value": skills.language|default(null), "required": true, "class": "form-control") }}
			
			<label for="language_other">Additional languages</label>
			{{ text_field("language_other", "value": skills.language_other|default(null), "placeholder": "english, italian,...", "class": "form-control") }}
			
			<label for="communication">Communication skills</label>
			{{ text_area("communication", "value": skills.communication|default(null), "class": "form-control") }}
			
			<label for="organization">Organization skills</label>
			{{ text_area("organization", "value": skills.organization|default(null), "class": "form-control") }}
			
			<label for="business">Business skills</label>
			{{ text_area("business", "value": skills.business|default(null), "class": "form-control") }}
			
			<label for="skills_other">Other skills</label>
			{{ text_area("skills_other", "value": skills.skills_other|default(null), "class": "form-control") }}
			
			
			{% set licences = {'A': 'A', 'B': 'B', 'C': 'C', 'D': 'D', 'F': 'F', 'G': 'G', 'H': 'H'} %}
			<label for="drivers_licence">Drivers licence</label>						
			<select name="drivers_licence[]" class="selectpicker form-control" data-style="btn-primary" multiple>
				{% for id, name in licences %}
					{% set flag = false %}
					{% for j in skills.drivers_licence %}
						{% if id is sameas(j) %}
							<option value="{{ id }}" selected> {{ name }} </option>
							{% set flag = true %}
							{% break %}
						{% endif %}
					{% endfor %}
					{% if flag is false %}
						<option value="{{ id }}"> {{ name }} </option>
					{% endif %}
				{% endfor %}
			</select>
			
			{{ submit_button("Save",  "name": "save", "class": "btn btn-lg btn-primary btn-block") }}
			
		</form>
		
	</section>

{% endblock %}

