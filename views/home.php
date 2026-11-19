{{ include('layouts/header.php', {title: 'Side Quest - Video Game Store'}) }}

<h2>Find Your Next Adventure!</h2>
<p>Explore our collection of video games across your favorite platforms.</p>

<div class="page-title">
    <h2>Games Available</h2>
    
    {% if session.user_privilege is defined and session.user_privilege == 1 %}
        <a class="button" href="{{base}}/game/create">Add a Game</a>
    {% endif %}

</div>

{# Loop through the games received from HomeController and display each one as a card #}

<div class="game-grid">
    {% for game in games %}

        <div class="game-card">

            <a href="{{base}}/game/show?id={{game.id}}">
                <img src="{{asset}}/images/{{game.image}}" alt="{{game.title}}">

                <div class="game-card-content">
                    <h3>{{game.title}}</h3>
                    <p>Released: {{game.release_date}}</p>
                </div>
            </a>

            {% if session.user_privilege is defined and session.user_privilege == 2 %}


                {% set wishlistId = 0 %}

                {% for item in wishlists %}
                    {% if item.game_id == game.id and item.user_id == session.user_id %}
                        {% set wishlistId = item.id %}
                    {% endif %}
                {% endfor %}

                <button type="button"
                        class="wishlist-heart"
                        data-game-id="{{game.id}}"
                        data-wishlist-id="{{wishlistId}}"
                        title="{% if wishlistId %}Remove from Wishlist{% else %}Add to Wishlist{% endif %}">
                    <img
                        src="{{asset}}/images/star-{% if wishlistId %}filled{% else %}empty{% endif %}.svg"
                        alt="Wishlist star">
                </button>

            {% endif %}
        </div>
    {% endfor %}
</div>


{{ include('layouts/footer.php') }}