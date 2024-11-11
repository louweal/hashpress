import 'splitting/dist/splitting.css';
import Splitting from 'splitting';

export const initSplitting = () => {
    let h1 = document.querySelector('h1'); // first h1 on the page
    if (!h1) return;

    h1.setAttribute('data-splitting', 'chars');

    Splitting();
};
