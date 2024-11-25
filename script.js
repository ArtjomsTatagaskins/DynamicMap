document.addEventListener("DOMContentLoaded", () => {
    const mapContainer = document.getElementById("map-container");
    const viewMapButton = document.getElementById("view-map");

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
                // console.log("SVG loaded successfully");
                setupTooltip();
            })
            .catch(err => console.error('Kļūda ielādējot SVG:', err));
    };

    const setupTooltip = () => {
        const roomElements = document.querySelectorAll('.room');
        const tooltip = document.querySelector('.tooltip');

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

       // console.log("Selected date:", selectedDate);

        fetch(`/lib/schedule.php?selected-date=${encodeURIComponent(selectedDate)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP kļūda! statuss: ${response.status}`);
                }
                return response.json();
            })
            .then(rooms => {
                // console.log("Rooms from server:", rooms);

                if (rooms.error) {
                    // console.error("Server error:", rooms.error);
                    alert("Kļūda, ielādējot datus");
                    return;
                }
                if (rooms.message) {
                    alert(rooms.message);
                    return;
                }

                const roomElements = document.querySelectorAll('.room');
                roomElements.forEach(room => {
                    const roomId = room.getAttribute('id');
                    if (rooms.includes(roomId)) {
                        room.classList.add('highlight');
                        // console.log(`Room ${roomId} highlighted`);
                    } else {
                        room.classList.remove('highlight');
                    }
                });
            })
            .catch(err => console.error('Kļūda, iegūstot telpas: ', err));
    });
});
