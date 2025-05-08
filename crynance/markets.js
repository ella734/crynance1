// markets.js

document.addEventListener('DOMContentLoaded', function() {
    fetchMarketPrices();

    // Refresh button event listener
    document.getElementById('refresh-btn').addEventListener('click', function() {
        fetchMarketPrices();
    });

    function fetchMarketPrices() {
        fetch('https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=bitcoin,ethereum,solana')
            .then(response => response.json())
            .then(data => {
                let tableBody = document.querySelector('#crypto-prices tbody');
                tableBody.innerHTML = ''; // Clear any existing rows

                data.forEach(crypto => {
                    let row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${crypto.name} (${crypto.symbol.toUpperCase()})</td>
                        <td>$${crypto.current_price.toLocaleString()}</td>
                        <td class="${crypto.price_change_percentage_24h >= 0 ? 'positive' : 'negative'}">
                            ${crypto.price_change_percentage_24h.toFixed(2)}%
                        </td>
                        <td>$${crypto.market_cap.toLocaleString()}</td>
                        <td><button class="buy-crypto-btn">Buy ${crypto.name}</button></td>
                    `;
                    tableBody.appendChild(row);
                });

                attachBuyHandlers(); // Attach handlers after buttons are created
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    function attachBuyHandlers() {
        const buyButtons = document.querySelectorAll('.buy-crypto-btn');
        buyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const crypto = button.innerText.split(' ')[1];
                alert(`You are purchasing ${crypto}!`);
            });
        });
    }
});
