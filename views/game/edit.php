{{ include('layouts/header.php', {'title': 'Edit Game - Side Quest'})}}

<div class="form-container">

    <h2>Edit Game</h2>

    <form class="game-form" method="post">

        <div>
            <label>Title</label>
            <input type="text" name="title" value="{{game.title}}" required>
        </div>

        <div>
            <label>Release Date</label>
            <input type="date" name="release_date" value="{{game.release_date}}" required>
        </div>

        <div>
            <label>Description</label>
            <textarea name="description" required>{{game.description}}</textarea>
        </div>

        <div>
            <label>Max Local Players</label>
            <input type="number" name="max_local_players" min="1" value="{{game.max_local_players}}" required>
        </div>

        <div>
            <label>Developer</label>
            <select name="developer_id" required>
                {% for developer in developers %}
                    <option value="{{developer.id}}" {% if developer.id == game.developer_id %}selected{% endif %}>{{developer.name}}</option>
                {% endfor %}
            </select>
        </div>

        <div>
            <label>Genre</label>
            <select name="genre_id" required>
                {% for genre in genres %}
                    <option value="{{genre.id}}" {% if genre.id == game.genre_id %}selected{% endif %}>{{genre.name}}</option>
                {% endfor %}
            </select>
        </div>

        <div>
            <input type="submit" value="Save Changes">
        </div>

    </form>

    <a class="back-button" href="{{base}}/game/show?id={{game.id}}">Back to Game</a>

</div>

{{ include('layouts/footer.php')}}
