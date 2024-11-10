import 'splitting/dist/splitting.css';
import Splitting from 'splitting';

export const initSplitting = () => {
    let h1 = document.querySelector('.hero .editor h1');
    if (!h1) return;

    h1.setAttribute('data-splitting', 'chars');

    Splitting();
};
