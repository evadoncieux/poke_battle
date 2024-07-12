import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

document.addEventListener('DOMContentLoaded', (event) => {
    const flipCards = document.querySelectorAll('.flip-card');

    const handleClick = (event) => {
        const clickedCard = event.currentTarget.querySelector('.flip-card-inner');
        clickedCard.classList.toggle('reveal');
    };

    flipCards.forEach(card => {
        card.addEventListener('click', handleClick);
    });
});

