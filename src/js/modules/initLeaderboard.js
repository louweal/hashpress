export const initLeaderboard = async () => {
    let leaderboard = document.querySelector('.leaderboard');
    if (!leaderboard) return;

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

async function getLeaderboardData() {
    // console.log('get data');
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
            console.error(`Error fetching data: ${data.error}`);
            return;
        }
        return data;
    } catch (error) {
        console.error(`Error fetching data:`, error);
    }
}
