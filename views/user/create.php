{{ include('layouts/header.php', {title: 'Side Quest - Create User', activePage: 'createUser'}) }}

<div class="registration-container">

    <h2>Registration</h2>

    {% if errors is defined %}
        <div class="error">
            <ul>
                {% for error in errors %}
                    <li>{{ error }}</li>
                {% endfor %}
            </ul>
        </div>
    {% endif %}

    <form method="post">

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{user.name}}">

        <label for="username">Username</label>
        <input type="email" id="username" name="username"
            placeholder="Use your email" value="{{user.username}}">

        <label for="password">Password</label>
        <input type="password" id="password" name="password">

        <label for="privilege">Privilege</label>
        <select id="privilege" name="privilege_id">
            <option value="">Select privilege</option>
            {% for privilege in privileges %}
                <option value="{{privilege.id}}"
                    {% if privilege.id == user.privilege_id %}selected{% endif %}>
                    {{privilege.privilege}}
                </option>
            {% endfor %}
        </select>

        <input type="submit" class="btn" value="Save">

    </form>

</div>

{{ include('layouts/footer.php') }}
