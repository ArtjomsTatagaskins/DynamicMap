document.addEventListener("DOMContentLoaded", () => {
    const mapContainer = document.getElementById("map-container");
    const viewMapButton = document.getElementById("view-map");
    const tooltip = document.querySelector('.tooltip');

    const loadMap = () => {
        fetch('/styles/images/finalv2building.svg')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP kļūda! statuss: ${response.status}`);
                }
                return response.text();
            })
            .then(svgContent => {
                mapContainer.innerHTML = svgContent;
                setupTooltip();
            })
            .catch(err => console.error('Kļūda ielādējot SVG:', err));
    };

    const setupTooltip = () => {
        const roomElements = document.querySelectorAll('.room');
        roomElements.forEach(room => {
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
    };

    loadMap();

    viewMapButton.addEventListener("click", () => {
        const selectedDate = document.getElementById("selected-date").value;

        if (!selectedDate) {
            alert("Lūdzu, izvēlieties datumu.");
            return;
        }

        fetch(`/lib/schedule.php?selected-date=${encodeURIComponent(selectedDate)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP kļūda! statuss: ${response.status}`);
                }
                return response.json();
            })
            .then(rooms => {
                if (rooms.error) {
                    alert(rooms.error);
                    return;
                }
                if (rooms.message) {
                    alert(rooms.message);
                    return;
                }

                const roomElements = document.querySelectorAll('.room');
                roomElements.forEach(room => {
                    const roomId = room.getAttribute('id');
                    if (roomId in rooms) {
                        room.classList.add('highlight');
                        room.setAttribute('aria-label', `Telpa: ${roomId}, Priekšmets: ${rooms[roomId]}`);
                    } else {
                        room.classList.remove('highlight');
                        room.setAttribute('aria-label', `Telpa: ${roomId}`);
                    }
                });
            })
            .catch(err => console.error('Kļūda, iegūstot telpas: ', err));
    });
});
