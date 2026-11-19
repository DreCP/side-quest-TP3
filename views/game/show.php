
{{include('layouts/header.php', {title: game.title ~ ' - Side Quest'})}}

<h2>{{game.title}}</h2>

<div class="game-details">

    <div class="game-image">
        <img src="{{asset}}/images/{{game.image}}" alt="{{game.title}}">
    </div>

    <div class="game-info">

        <p><strong>Release Date:</strong> {{game.release_date}}</p>

        <p><strong>Developer:</strong> {{developerName}}</p>

        <p><strong>Genre:</strong> {{genreName}}</p>

        <p><strong>Max Local Players:</strong> {{game.max_local_players}}</p>


        <h3>Description</h3>

        <p>{{game.description}}</p>

        {# Match the game platform and display the available formats #}
        <h3>Formats</h3>

        {% for gamePlatform in gamePlatforms %}
            {% if gamePlatform.game_id == game.id %}
                {% for platform in platforms %}
                    {% if platform.id == gamePlatform.platform_id %}

                        <div class="game-format">
                            {{platform.name}} -
                            {{gamePlatform.copy_type}} -
                            ${{gamePlatform.price}}

                            {% if session.user_privilege is defined and session.user_privilege == 1 %}
                                <form action="{{base}}/platform/delete" method="post">
                                    <input type="hidden" name="game_id" value="{{game.id}}">
                                    <input type="hidden" name="platform_id" value="{{gamePlatform.platform_id}}">
                                    <input type="hidden" name="copy_type" value="{{gamePlatform.copy_type}}">
                                    <input type="submit" value="Delete" class="delete-format">
                                </form>
                            {% endif %}
                        </div>

                    {% endif %}
                {% endfor %}
            {% endif %}
        {% endfor %}


    </div>

</div>

<div class="game-actions">
    <a class="back-button" href="{{base}}/">Back to Library</a>

    {% if session.user_privilege is defined and session.user_privilege == 1 %}
        <a class="button" href="{{base}}/game/edit?id={{game.id}}">Edit Game</a>
        <a class="button" href="{{base}}/platform/create?id={{game.id}}">Add Platform</a>

        <form action="{{base}}/game/delete" method="post">
            <input type="hidden" name="id" value="{{game.id}}">
            <input type="submit" value="Delete Game" class="delete-button">
        </form>
    {% endif %}

</div>

{{include('layouts/footer.php')}}
