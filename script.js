fetch('/styles/images/finalv2building.svg')
    .then(response => response.text())
    .then(svgContent => {
        document.getElementById('map-container').innerHTML = svgContent;

        const rooms = document.querySelectorAll('.room');
        const tooltip = document.querySelector('.tooltip');

        rooms.forEach(room => {
            room.addEventListener('mousemove', (e) => {
                tooltip.style.left = `${e.pageX + 10}px`;
                tooltip.style.top = `${e.pageY + 10}px`;
                tooltip.style.display = 'block';
                tooltip.textContent = room.getAttribute('aria-label');
            });

            room.addEventListener('mouseleave', () => {
                tooltip.style.display = 'none';
            });
        });
    })
    .catch(err => console.error('Error loading SVG:', err));
