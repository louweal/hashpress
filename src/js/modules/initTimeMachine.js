export const initTimeMachine = async () => {
    let timeMachine = document.querySelector('#time-machine');
    if (!timeMachine) return;

    let currency = document.querySelector('.time-machine-currency');
    let input = document.querySelector('.time-machine-input');
    let outputBlock = document.querySelector('.time-machine-output');
    if (!outputBlock) return;

    input.addEventListener('input', () => {
        handleInputChange();
    });

    handleCurrencyChange(outputBlock);

    let date = document.querySelector('.time-machine-date');
    let prices = await handleDateChange();

    currency.addEventListener('change', () => {
        handleCurrencyChange(outputBlock, prices);
    });

    if (input.value) {
        date.addEventListener('change', async () => {
            prices = await handleDateChange();
        });

        if (currency) {
            if (currency.value) {
                console.log(currency.value + ' selected');
                if (prices) {
                    // console.log(prices[currency.value]);

                    let priceOutput = outputBlock.querySelector('#price');
                    priceOutput.innerText = Math.round(prices[currency.value] * 1000000) / 1000000;

                    let currencyOutput = outputBlock.querySelector('#currency2');
                    currencyOutput.innerText = currency.value.toUpperCase();
                } else {
                    console.log('no prices');
                }
            }
        }
    }

    async function handleCurrencyChange(outputBlock, prices) {
        let currency = document.querySelector('.time-machine-currency');
        if (!currency) return;
        if (!currency.value) return;

        if (prices) {
            let priceOutput = outputBlock.querySelector('#price');
            priceOutput.innerText = Math.round(prices[currency.value] * 1000000) / 1000000;
        }

        let currencyOutput = outputBlock.querySelector('#currency');
        currencyOutput.innerText = currency.value.toUpperCase();

        let currencyOutput2 = outputBlock.querySelector('#currency2');
        currencyOutput2.innerText = currency.value.toUpperCase();
    }

    async function handleInputChange() {
        let input = document.querySelector('.time-machine-input');
        if (!input) return;
        if (!input.value) return;
        if (value.startsWith('0.0.')) {
            console.log('fetch hist balance');
        } else {
            let isNumber = /^\d+$/.test(value);
            if (isNumber) {
                console.log('convert');
            }
        }
    }

    async function handleDateChange() {
        let date = document.querySelector('.time-machine-date');
        if (!date) return;
        if (!date.value) return;

        let humanReadableDate = new Date(date.value).toDateString();

        let dateOutput = outputBlock.querySelector('#date');
        dateOutput.innerText = humanReadableDate;

        if (!inFuture(date.value)) {
            let formattedDate = formatDateToDMY(date.value);

            let prices = await fetchPrice(formattedDate);
            return prices;
        } else {
            console.error('Cannot fetch price in the future');
        }
    }

    function inFuture(date) {
        console.log(date);
        let timestamp = new Date(date).getTime();
        console.log(timestamp);
        return new Date(timestamp) > new Date();
    }

    function formatDateToDMY(dateString) {
        const [year, month, day] = dateString.split('-');
        console.log(year, month, day);
        return `${day}-${month}-${year}`;
    }

    async function fetchPrice(date) {
        // fetches hbar prices on given date
        let url = `https://api.coingecko.com/api/v3/coins/hedera-hashgraph/history?date=${date}`;

        try {
            let response = await fetch(url);
            let data = await response.json();

            let marketData = data['market_data'];
            let prices = marketData['current_price'];
            return prices;
        } catch (error) {
            console.error(error);
        }
    }
};
