export const initTimeMachine = async () => {
    let timeMachine = document.querySelector('#time-machine');
    let outputBlock = document.querySelector('.time-machine-output');
    if (!timeMachine || !outputBlock) return;

    let prices;
    prices = await handleDateChange();
    await handleChange(prices);

    let input = document.querySelector('.time-machine-input');
    input.addEventListener('input', async () => {
        await handleChange(prices);
    });

    let date = document.querySelector('.time-machine-date');
    date.addEventListener('change', async () => {
        prices = await handleDateChange();
        await handleChange(prices);
    });

    let currency = document.querySelector('.time-machine-currency');
    currency.addEventListener('change', async () => {
        await handleChange(prices);
    });

    async function handleChange(prices) {
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
            balance = +input.value;
        }

        // output
        let inBalanceOutput = outputBlock.querySelector('#in-balance');
        inBalanceOutput.innerText = balance;

        let outBalanceOutput = outputBlock.querySelector('#out-balance');

        const [toDateString, open, high, low, close, volume] = prices;

        outBalanceOutput.innerHTML =
            'Low: ' +
            Math.round(low * balance * 100) / 100 +
            ' USD<br>' +
            'High: ' +
            Math.round(high * balance * 100) / 100 +
            ' USD<br>' +
            'Open: ' +
            Math.round(open * balance * 100) / 100 +
            ' USD<br>' +
            'Close: ' +
            Math.round(close * balance * 100) / 100 +
            ' USD';
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
        let timestamp = new Date(date).getTime();
        return new Date(timestamp) > new Date();
    }

    function formatDateToDMY(dateString) {
        const [year, month, day] = dateString.split('-');
        return `${day}-${month}-${year}`;
    }

    async function fetchPrice(dateStr) {
        console.log(dateStr);
        const date = new Date(dateStr);
        const startTime = date.getTime();
        const endTime = startTime + 86400000; // Add 24 hours in milliseconds

        // Binance API URL for historical daily OHLC data
        const url = `https://api.binance.com/api/v3/klines?symbol=HBARUSDT&interval=1d&startTime=${startTime}&endTime=${endTime}`;

        try {
            const response = await fetch(url);
            const data = await response.json();

            if (data.length === 0) {
                console.log('No data found for this date.');
                return;
            }
            return data[0];
        } catch (error) {
            console.error('Error fetching data:', error);
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
};
