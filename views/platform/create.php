
{{ include('layouts/header.php', {'title': 'Add Platform - Side Quest'})}}

<div class="form-container">

    <h2>Add Platform</h2>

    <p>Add a new format for <strong>{{game.title}}</strong></p>

    <form class="game-form" method="post">

        <input type="hidden" name="game_id" value="{{game.id}}">

        <div>
            <label>Platform</label>
            <select name="platform_id" required>
                {% for platform in platforms %}
                    <option value="{{platform.id}}">{{platform.name}}</option>
                {% endfor %}
            </select>
        </div>

        <div>
            <label>Copy Type</label>
            <select name="copy_type" required>
                <option value="new">New</option>
                <option value="used">Used</option>
            </select>
        </div>

        <div>
            <label>Price</label>
            <input type="number" name="price" step="0.01" min="0" required>
        </div>

        <div>
            <input type="submit" value="Add Platform">
        </div>

    </form>

    <a class="back-button" href="{{base}}/game/show?id={{game.id}}">Back to Game</a>

</div>

{{ include('layouts/footer.php')}}
