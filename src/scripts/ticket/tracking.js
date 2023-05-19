// Function to handle tracking and untracking tickets
function toggleTicketTracking(ticketId, userId) {
    const trackButton = document.querySelector(`.track-button[data-ticket-id="${ticketId}"]`);
    const untrackButton = document.querySelector(`.untrack-button[data-ticket-id="${ticketId}"]`);

    if (trackButton.style.display !== "none") {
        // Perform track action
        submitTicketTracking(ticketId, userId).then(() => {
            trackButton.style.display = "none";
            untrackButton.style.display = "block";
        });
    } else {
        // Perform untrack action
        removeTicketTracking(ticketId, userId).then(() => {
            trackButton.style.display = "block";
            untrackButton.style.display = "none";
        });
    }
}

// Function to submit ticket tracking
// Function to submit ticket tracking
// Function to submit ticket tracking
function submitTicketTracking(ticketId, userId) {
    return fetch('../../actions/action_submit_tracking_user_ticket.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            ticketId: ticketId,
            userId: userId
        })
    })
    .then(response => response.json())
    .then(data => {
        // Handle the response if needed
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Function to remove ticket tracking
function removeTicketTracking(ticketId, userId) {
    return fetch('../../actions/action_remove_ticket_tracking.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            ticketId: ticketId,
            userId: userId
        })
    })
    .then(response => response.json())
    .then(data => {
        // Handle the response if needed
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


// Add event listeners to track buttons
const trackButtons = document.querySelectorAll('.track-button');
const untrackButtons = document.querySelectorAll('.untrack-button');

    // Attach event listener to track buttons
trackButtons.forEach(button => {
    button.addEventListener('click', () => {
        const ticketId = button.dataset.ticketId;
        const userId = button.dataset.userId;
        toggleTicketTracking(ticketId, userId);
    });
});

    // Attach event listener to untrack buttons
untrackButtons.forEach(button => {
    button.addEventListener('click', () => {
        const ticketId = button.dataset.ticketId;
        const userId = button.dataset.userId;
        toggleTicketTracking(ticketId, userId);
    });
});
