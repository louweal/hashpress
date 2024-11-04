import 'splitting/dist/splitting.css';
import Splitting from 'splitting';
import { doc } from 'prettier';

export const initSplitting = () => {
    // let headings = document.querySelectorAll('.hero .editor h1');
    // [...headings].forEach((heading) => {
    //     heading.setAttribute('data-splitting', 'chars');
    // });

    let heading = document.querySelector('.hero .editor h1');
    heading.setAttribute('data-splitting', 'chars');

    Splitting();
};
