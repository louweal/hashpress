export const initTimeMachine = async () => {
    let timeMachine = document.querySelector('#time-machine');
    let outputBlock = document.querySelector('.time-machine-output');
    if (!timeMachine || !outputBlock) return;

    let prices;
    let lowestPrice;
    prices = await handleDateChange();
    lowestPrice = await getLowestPriceOnDate();
    await handleChange(prices, lowestPrice);

    let input = document.querySelector('.time-machine-input');
    input.addEventListener('input', async () => {
        await handleChange(prices, lowestPrice);
    });

    let date = document.querySelector('.time-machine-date');
    date.addEventListener('change', async () => {
        prices = await handleDateChange();
        lowestPrice = await getLowestPriceOnDate();
        await handleChange(prices, lowestPrice);
    });

    let currency = document.querySelector('.time-machine-currency');
    currency.addEventListener('change', async () => {
        lowestPrice = await getLowestPriceOnDate();
        await handleChange(prices, lowestPrice);
    });

    async function handleChange(prices, lowestPrice) {
        let input = document.querySelector('.time-machine-input');
        let date = document.querySelector('.time-machine-date');
        let currency = document.querySelector('.time-machine-currency');
        if (!date || !date.value) return;
        if (!input || !input.value) return;
        if (!currency || !currency.value) return;

        let timestamp = new Date(date.value).getTime() / 1000;

        let balance;

        if (input.value.startsWith('0.0.')) {
            let account = input.value;
            let url = `https://mainnet-public.mirrornode.hedera.com/api/v1/balances?account.id=${account}&timestamp=${timestamp}`;
            balance = await fetchBalance(url);
        } else {
            // let isNumber = /^\d+$/.test(input.value);
            // if (isNumber) {
            // }
            balance = +input.value;
        }

        // output
        let inBalanceOutput = outputBlock.querySelector('#in-balance');
        inBalanceOutput.innerText = balance;

        let outBalanceOutput = outputBlock.querySelector('#out-balance');
        outBalanceOutput.innerText = balance * prices[currency.value];

        let lowestOutBalanceOutput = outputBlock.querySelector('#lowest-out-balance');
        lowestOutBalanceOutput.innerText = balance * lowestPrice;

        let priceOutput = outputBlock.querySelector('#price');
        priceOutput.innerText = prices[currency.value];

        let currencyOutputs = document.querySelectorAll('.currency');
        currencyOutputs.forEach((currencyOutput) => {
            currencyOutput.innerText = currency.value.toUpperCase();
        });

        // output lowest price

        let lowestPriceOutput = outputBlock.querySelector('#lowest-price');
        lowestPriceOutput.innerText = lowestPrice;

        const offsetMinutes = new Date().getTimezoneOffset();
        const offsetHours = -offsetMinutes / 60; // Negative because offset is minutes behind UTC
        const timezone = `UTC${offsetHours >= 0 ? '+' : ''}${offsetHours}`;

        let timezoneOutput = outputBlock.querySelector('#timezone');
        timezoneOutput.innerText = timezone;
    }

    async function handleDateChange() {
        let date = document.querySelector('.time-machine-date');
        if (!date) return;
        if (!date.value) return;

        let humanReadableDate = new Date(date.value).toDateString();

        let dateOutput = outputBlock.querySelector('#date');
        dateOutput.innerText = humanReadableDate;

        let dateOutput2 = outputBlock.querySelector('#date2');
        dateOutput2.innerText = humanReadableDate;

        if (!inFuture(date.value)) {
            let formattedDate = formatDateToDMY(date.value);
            console.log(formattedDate);

            let prices = await fetchPrice(formattedDate);
            return prices;
        } else {
            console.error('Cannot fetch price in the future');
        }
    }

    function inFuture(date) {
        let timestamp = new Date(date).getTime();
        return new Date(timestamp) > new Date();
    }

    function formatDateToDMY(dateString) {
        const [year, month, day] = dateString.split('-');
        return `${day}-${month}-${year}`;
    }

    async function fetchPrice(date) {
        // fetches hbar prices on given date
        let url = `https://api.coingecko.com/api/v3/coins/hedera-hashgraph/history?date=${date}`;

        try {
            let response = await fetch(url);
            let data = await response.json();
            return data['market_data']['current_price'];
        } catch (error) {
            console.error(error);
        }
    }

    async function fetchBalance(url) {
        try {
            let response = await fetch(url);
            let data = await response.json();
            if (data['balances']) {
                if (data['balances'].length > 0) {
                    let balance = data['balances'][0]['balance'];
                    return balance / 1e8;
                }
            } else {
                console.error('Invalid request to Hedera Mirrornode');
            }
        } catch (error) {
            console.error(error);
        }
    }

    async function getLowestPriceOnDate() {
        let date = document.querySelector('.time-machine-date');
        if (!date) return;
        if (!date.value) return;
        let currency = document.querySelector('.time-machine-currency');
        if (!currency) return;
        if (!currency.value) return;

        try {
            const userTimezoneOffset = new Date().getTimezoneOffset() * 60; // Offset in seconds
            const startOfDay = Math.floor(new Date(date.value).setHours(0, 0, 0, 0) / 1000) - userTimezoneOffset;
            const endOfDay = startOfDay + 86400; // Add 24 hours (86400 seconds)

            const url =
                `https://api.coingecko.com/api/v3/coins/hedera-hashgraph/market_chart/range` +
                `?vs_currency=${currency.value}&from=${startOfDay}&to=${endOfDay}`;
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error(`Error fetching data: ${response.statusText}`);
            }

            const data = await response.json();

            // Find the lowest price in the returned price data
            const lowestPrice = data.prices.reduce((min, [_, price]) => Math.min(min, price), Infinity);

            // console.log(
            //     `The lowest price of hedera on ${date.value} was ${lowestPrice} ${currency.value.toUpperCase()}.`,
            // );
            return lowestPrice;
        } catch (error) {
            console.error('Error fetching or processing data:', error);
            throw error;
        }
    }
};
