export const initLeaderboard = async () => {
    let leaderboard = document.querySelector('.leaderboard');
    if (!leaderboard) return;

    init(leaderboard);

    let searchForm = document.querySelector('.leaderboard__search-form');

    if (searchForm) {
        searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
        });
    }

    let searchInput = document.querySelector('.leaderboard__search');
    let searchResults = document.querySelector('.leaderboard__search-results');
    if (!searchInput) return;

    let loadMoreButton = leaderboard.querySelector('.btn.load-more');
    if (loadMoreButton) {
        const items = document.querySelectorAll('.leaderboard__table__tr');

        let data;

        loadMoreButton.addEventListener('click', async () => {
            let start_index = +loadMoreButton.dataset.start;
            const table = document.querySelector('.leaderboard__table');

            if (!data) {
                data = await getLeaderboardData();
                data = JSON.parse(data);
            }

            for (let i = start_index; i < Math.min(data.length, start_index + 25); i++) {
                const tr = document.createElement('div');
                tr.className = 'leaderboard__table__tr';

                const td1 = document.createElement('div');
                td1.textContent = i + 1;
                tr.appendChild(td1);
                const td2 = document.createElement('div');
                td2.textContent = data[i].account;
                tr.appendChild(td2);
                const td3 = document.createElement('div');
                td3.textContent = Math.round(data[i].balance / 1e8);
                tr.appendChild(td3);

                table.appendChild(tr);
                tr.classList.add('is-active');
            }

            // Hide the button if all items are visible
            if (start_index + 25 > data.length) {
                loadMoreButton.style.display = 'none';
            } else {
                loadMoreButton.dataset.start = start_index + 25;
            }
        });
    }

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
                    (i + 1) +
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

    // location.reload();
    window.location.href = window.location.href.split('?')[0] + '?refresh=' + new Date().getTime();
}

function updateProgress(progress) {
    let progressElem = document.querySelector('.leaderboard__progress');

    if (progressElem) {
        progressElem.style.width = (100 * progress) / 561 + '%';
    }
}

async function fetchBalances(path, page = 0) {
    updateProgress(page);

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
                res2 = await fetchBalances(nextpage, page + 1);
            }
        })
        .catch((error) => {
            return res;
        });

    return res.concat(res2);
}

async function sendDataToServer(data, page) {
    try {
        const response = await fetch(hashpressTheme.setLeaderboardDataUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': hashpressTheme.nonce,
            },
            body: JSON.stringify({
                data: JSON.stringify(data),
                page: page,
                fetchedAt: new Date().toISOString(),
            }),
        });

        const result = await response.json();

        if (result.success) {
            console.log('Successfully updated data');
        } else {
            console.error('Failed to update transaction IDs');
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

async function getLeaderboardData() {
    console.log('get data');
    try {
        const response = await fetch(`${hashpressTheme.getLeaderboardDataUrl}`, {
            method: 'GET',
            headers: {
                'X-WP-Nonce': hashpressTheme.nonce,
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
