{% extends "templates/base_employer.volt" %}

{% block title %} Student CVs {% endblock %}


{% block navigation %}

	{{ partial("partials/employer_partials/employer_navbar") }}

{% endblock %}


{% block bookmarks %}
	
	{{ partial("partials/employer_partials/employer_bookmarks", [ 'bookmarks': bookmarks]) }}
	
{% endblock %}


{% block search %}

	{{ partial("partials/employer_partials/search_form") }}
	<hr>

{% endblock %}


{% block content %}

	{{ partial("partials/flash", ['flashSession' : flashSession|default(null)]) }}
	
	<h3> Students </h3>
	<hr>
	{{ partial("partials/employer_partials/" ~student_list) }}

{% endblock %}
