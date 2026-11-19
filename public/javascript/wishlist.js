/**
 * Initializes the wishlist heart buttons.
 * @returns {void}
 */
function main() {
    const hearts = document.querySelectorAll('.wishlist-heart');

    hearts.forEach(function(heart) {
        heart.addEventListener('click', function() {
            handleHeartClick(heart);
        });
    });
}

/**
 * Sends a request to add or remove a game from the wishlist.
 * @param {string} url - The PHP route.
 * @param {FormData} data - The data to send.
 * @returns {Promise<Object>} The PHP response.
 */
async function saveWishlist(url, data) {
    const response = await fetch(url, {
        method: 'POST',
        body: data
    });

    return await response.json();
}

/**
 * Updates the heart after a successful request.
 * @param {HTMLElement} heart - The heart button.
 * @param {string|number} id - The wishlist entry ID.
 * @returns {void}
 */
function updateHeart(heart, id) {
    heart.dataset.wishlistId = id;

const image = heart.querySelector('img');

if (id != 0) {
    image.src = '/public/images/star-filled.svg';
    heart.title = 'Remove from Wishlist';
} else {
    image.src = '/public/images/star-empty.svg';
    heart.title = 'Add to Wishlist';
}
}

/**
 * Adds or removes a game when its heart is clicked.
 * @param {HTMLElement} heart - The heart button.
 * @returns {Promise<void>}
 */
async function handleHeartClick(heart) {
    const gameId = heart.dataset.gameId;
    const wishlistId = heart.dataset.wishlistId;

    const data = new FormData();
    let url;

    if (wishlistId != 0) {
        url = '/wishlist/delete';
        data.append('id', wishlistId);
    } else {
        url = '/wishlist/store';
        data.append('game_id', gameId);
    }

    const result = await saveWishlist(url, data);

    if (result.success) {
        if (wishlistId != 0) {
            updateHeart(heart, 0);
        } else {
            updateHeart(heart, result.id);
        }
    }
}

main();
