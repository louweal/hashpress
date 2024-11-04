export const initPayDemo = () => {
    let payDemos = document.querySelectorAll('.js-pay-demo');
    if (!payDemos) return;

    payDemos.forEach((payDemo) => {
        let payDemoInput = payDemo.querySelector('.js-pay-demo-input');

        let payDemoOutput = payDemo.querySelector('.js-pay-demo-output');
        let button = payDemoOutput.querySelector('.hederapay-transaction-button');

        console.log(button.dataset.attributes);

        // console.log(payDemoInput);

        payDemoInput.addEventListener('change', (event) => {
            let shortcode = payDemoInput.value;

            let attributes = parseAttributes(shortcode);

            console.log(attributes);
        });
    });
};

function parseAttributes(input) {
    const trimmedInput = input.slice(1, -1);

    const regex = /(\w+)="([^"]*)"/g;

    let match;
    const attributes = {};

    while ((match = regex.exec(trimmedInput)) !== null) {
        const key = match[1]; // the attribute name
        const value = match[2]; // the attribute value
        attributes[key] = value;
    }

    return attributes;
}
