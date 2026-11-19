<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }}</title>
    <link rel="stylesheet" href="{{asset}}/css/style.css">
</head>

<body>

<header>
    <div>
        <h1><a href="{{base}}/">SIDE QUEST</a></h1>
        <p>Video Game Store</p>
    </div>

    <div class="header-right">

        <div class="controller-buttons">
            <span class="green"></span>
            <span class="blue"></span>
            <span class="yellow"></span>
        </div>

        <nav class="user-navigation">

        {% if session.user_id is defined %}

            {% if session.user_privilege == 1 %}
                <a href="{{base}}/visitlog"
                class="{% if activePage == 'visitlog' %}active{% endif %}">
                    JOURNAL DE BORD
                </a>

                <a href="{{base}}/user/create"
                class="{% if activePage == 'createUser' %}active{% endif %}">
                    CREATE USER
                </a>
            {% endif %}

            <a href="{{base}}/logout">LOGOUT</a>

        {% else %}

            <a href="{{base}}/login"
            class="{% if activePage == 'login' %}active{% endif %}">
                LOGIN
            </a>

        {% endif %}

        </nav>
    </div>
</header>

<main>
