{{ include('layouts/header.php', {title: 'Side Quest - Login', activePage: 'login'}) }}

<div class="login-container">

    <h2>Login</h2>

    {% if errors is defined %}
        {% for error in errors %}
            <p>{{ error }}</p>
        {% endfor %}
    {% endif %}

    <form action="{{base}}/login" method="post">

        <label for="username">Email</label>
        <input
            type="email"
            id="username"
            name="username"
            value="{{ user.username|default('') }}"
            required
        >

        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            required
        >

        <button type="submit">Login</button>

    </form>

</div>

{{ include('layouts/footer.php') }}
