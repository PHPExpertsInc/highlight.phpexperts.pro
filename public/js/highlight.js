async function highlightCode() {
    const codeBlocks = document.querySelectorAll('code');

    const requests = Array.from(codeBlocks).map(codeBlock => {
        const lang = codeBlock.getAttribute('lang');
        const text = codeBlock.textContent;

        return fetch('https://highlight.phpexperts.pro/highlight', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'User-Agent': 'insomnium/0.2.3-a'
            },
            body: JSON.stringify({ lang, text })
        });
    });

    const responses = await Promise.all(requests);
    const highlightedCodes = await Promise.all(responses.map(response => response.text()));

    codeBlocks.forEach((codeBlock, index) => {
        codeBlock.innerHTML = highlightedCodes[index];
    });
}
highlightCode();
