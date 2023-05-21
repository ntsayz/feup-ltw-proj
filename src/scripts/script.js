

//     ---------                HOME PAGE FUNCTIONS     --------------

// toggle to show and hide the sidebar
const sidebarToggle = document.getElementById('sidebar-toggle-button');
const sidebar = document.querySelector('.sidebar');
sidebarToggle.addEventListener('click', () => {
  sidebar.classList.toggle('visible');
});






//      ---------                FAQ PAGE FUNCTIONS     --------------


 // Gets all the FAQ titles
 var faqTitles = document.getElementsByClassName("faq-title");
 for (var i = 0; i < faqTitles.length; i++) {
     faqTitles[i].addEventListener("click", toggleAnswer);
 }

 // Toggle the display of the FAQ answer
 function toggleAnswer() {
  var answerContainer = this.nextElementSibling;
  var answer = answerContainer.getElementsByClassName("faq-answer")[0];
  answer.classList.toggle("faq-answer-show");
}



var deleteButtons = document.querySelectorAll('.delete-button');

// Add event listeners to delete buttons
deleteButtons.forEach(function (button) {
    button.addEventListener('click', deleteFAQ);
});

// Function to handle the delete button click
function deleteFAQ() {
    var faqId = this.getAttribute('data-id');

    // Send an HTTP request to delete the FAQ with the specified ID
var deleteURL = '/actions/action_delete_faq.php?id=' + faqId;

    fetch(deleteURL, { method: 'DELETE' })
        .then(function (response) {
            if (response.ok) {
                // Reload the page to reflect the updated FAQ list
                location.reload();
            } else {
                console.error('Error deleting FAQ');
            }
        })
        .catch(function (error) {
            console.error('Error deleting FAQ:', error);
        });
}


//     ---------                EXTRA     --------------

const slider = document.getElementById("scrollableDiv");
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
    isDown = true;
    //slider.style.cursor = 'grabbing';
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
});
slider.addEventListener('mouseleave', () => {
    isDown = false;
    //slider.style.cursor = 'grab';
});
slider.addEventListener('mouseup', () => {
    isDown = false;
    //slider.style.cursor = 'grab';
});
slider.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 1; //scroll-fast
    slider.scrollLeft = scrollLeft - walk;
});



//     ---------                HOME PAGE -- TICKETS     --------------

var ticketBoxes = document.querySelectorAll('.ticket-box');
var overlays = document.querySelectorAll('.overlay');
var overlays1 = document.querySelectorAll('.overlay');

ticketBoxes.forEach(function(ticketBox) {
    ticketBox.addEventListener('click', function() {
        var overlayId = ticketBox.getAttribute('data-overlay-id');
        var overlay = document.getElementById(overlayId);
        if (overlay) {
            overlay.style.display = 'flex';
        }
    });
});
overlays.forEach(function(overlay) {
    overlay.addEventListener('click', function(event) {
        if (event.target === overlay || event.target.classList.contains('overlay-content-forms')) {
            overlay.style.display = 'none';
        }
    });
});

function openNewTicketOverlay() {
    document.getElementById('new-ticket-overlay').style.display = 'flex';
}

function openTicketFilterOverlay() {
    document.getElementById('filter-ticket-overlay').style.display = 'flex';
}

function closeticketFilterOverlay() {
    document.getElementById('filter-ticket-overlay').style.display = 'none';
}

function openTicketOverlay(ticketId) {
    const overlay = document.getElementById(`overlay-${ticketId}`);
    if (overlay) {
        overlay.style.display = 'flex';
    }
}

var ticketForwardButtons = document.querySelectorAll('.ticket-forward');
ticketForwardButtons.forEach(function(button) {
    button.addEventListener('click', forwardToTicket);
});

function forwardToTicket(event) {
    var ticketButton = event.target;
    var ticketId = ticketButton.dataset.ticketId;

    // Use the ticket ID in your logic
    var pageUrl = 'http://' + window.location.host + '/../../pages/ticket.php?ticket_id=' + ticketId;
    window.location.href = pageUrl;
}

document.addEventListener('DOMContentLoaded', function() {
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-button');
    const ticketIdElement = document.getElementById('ticket-data');
    const ticketId = ticketIdElement.getAttribute('data-ticket-id');

    sendButton.addEventListener('click', function() {
        const message = chatInput.value;

        const postData = new URLSearchParams();
        postData.append('message', message);
        postData.append('ticket_id', ticketId);

        fetch('../actions/action_insert_message.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: postData
        })
        .then(response => response.text())
        .then(text => {
            console.log(text);
            // You can perform additional actions after successful submission if needed
        })
        .catch(error => console.error('Error:', error));

        chatInput.value = '';
    });
});



var removeUserButtons = document.querySelectorAll('.remove-user-button');

// Add event listeners to remove user buttons
removeUserButtons.forEach(function (button) {
    button.addEventListener('click', removeUserFromDepartment);
});

// Function to handle the remove user button click
// Function to handle the remove user button click
function removeUserFromDepartment() {
    var userDepartmentId = this.getAttribute('data-user-id');
    var departmentId = this.getAttribute('data-department-id');

    // Send an HTTP request to remove the user from the department with the specified IDs
    var removeURL = '/actions/action_remove_agent_department.php';

    fetch(removeURL, { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ agent_id: userDepartmentId, department_id: departmentId, _method: 'DELETE' })
    })
        .then(function (response) {
            if (response.ok) {
                // Reload the page to reflect the updated user department list
                location.reload();
            } else {
                console.error('Error removing user from department');
            }
        })
        .catch(function (error) {
            console.error('Error removing user from department:', error);
        });
}



$("#filter-ticket-overlay form").on("submit", function(event) {
    event.preventDefault();

    // Serialize the form data
    let formData = $(this).serialize();

    // Send the filter values to the server-side script
    $.post("../actions/action_filter_tickets.php", formData, function(data) {
        // Insert the returned HTML into the #scrollabledivtickets
        $("#scrollabledivtickets").html(data);
    });
});








