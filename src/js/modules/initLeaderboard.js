export const initLeaderboard = async () => {
    let leaderboard = document.querySelector('.leaderboard');
    if (!leaderboard) return;

    init(leaderboard);

    let searchInput = document.querySelector('.leaderboard__search');
    let searchResults = document.querySelector('.leaderboard__search-results');
    if (!searchInput) return;

    let data = undefined;

    searchInput.addEventListener('input', async (e) => {
        let accountToFind = e.target.value;

        if (accountToFind.startsWith('0.0.')) {
            if (!data) {
                data = await getLeaderboardData();
                data = JSON.parse(data);
            }

            const i = data.findIndex((item) => item.account === accountToFind);

            if (i !== -1) {
                const foundAccount = data[i]; // Get the object using the index

                searchResults.innerText =
                    'Account ' +
                    accountToFind +
                    ' has ranking ' +
                    i +
                    ' and a balance of ' +
                    Math.round(foundAccount.balance / 1e8) +
                    ' hbar.';
            } else {
                // console.log('Account not found');
                searchResults.innerText = 'Account ' + accountToFind + ' not found.';
            }
        } else {
            //reset
            searchResults.innerText = '';
        }
    });
};

async function init(leaderboard) {
    let lastFetchDateString = leaderboard.dataset.fetchedAt;

    if (lastFetchDateString) {
        let lastFetchDate = new Date(lastFetchDateString);

        const fifteenMinutesAgo = new Date().getTime() - 15 * 60 * 1000; // 15 minutes in milliseconds

        if (lastFetchDate.getTime() > fifteenMinutesAgo) {
            // recently fetched
            console.log('already fetched recently');
            return;
        }
    }
    let data = await fetchBalances('/api/v1/balances');
    data = data.sort((a, b) => (a.balance > b.balance ? -1 : 1));

    sendDataToServer(data);
}

async function fetchBalances(path) {
    let min = 100000 * 1e8;
    let domain = 'https://mainnet.mirrornode.hedera.com';

    let query = domain + path;
    if (!path.includes('?account.balance=gte:' + min)) {
        query += '?account.balance=gte:' + min;
    }

    let res = [];
    let res2 = [];

    await fetch(query)
        .then((response) => response.text())
        .then(async (body) => {
            let data;
            try {
                data = JSON.parse(body);
            } catch (error) {
                return res;
            }

            let balances = data['balances'];

            if (!balances) {
                return;
            }

            for (let i = 0; i < balances.length; i++) {
                let balance = balances[i];
                res.push({ account: balance.account, balance: balance.balance });
            }

            let nextpage = data['links']['next'];
            if (nextpage !== null) {
                console.log(nextpage);
                res2 = await fetchBalances(nextpage);
            }
        })
        .catch((error) => {
            return res;
        });

    return res.concat(res2);
}

function sendDataToServer(data) {
    fetch(hashpressTheme.setLeaderboardDataUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-WP-Nonce': hashpressTheme.nonce,
        },
        body: JSON.stringify({
            data: JSON.stringify(data),
            fetchedAt: new Date().toISOString(),
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                console.log('Successfully updated data');
            } else {
                console.error('Failed to update transaction IDs');
            }
        })
        .catch((error) => console.error('Error:', error));
}

async function getLeaderboardData() {
    console.log('get data');
    try {
        const response = await fetch(`${hashpressTheme.getLeaderboardDataUrl}`, {
            method: 'GET',
            headers: {
                'X-WP-Nonce': phpData.nonce,
            },
        });

        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

        const data = await response.json();
        if (data.error) {
            console.error(`Error fetching data for ID ${id}: ${data.error}`);
            return;
        }
        return data;
    } catch (error) {
        console.error(`Error fetching data for ID ${id}:`, error);
    }
}
