

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
                console.error('Error deleting FAQw');
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
    overlay.addEventListener('click', function() {
        overlay.style.display = 'none';
    });
});
/* 

<?php
            require_once(__DIR__.'/../../database/tickets.php');
            require_once(__DIR__.'/../../database/user.php');
            require_once(__DIR__.'/../../database/status.php');
            $tickets = get_tickets();
            foreach ($tickets as $ticket) {
        ?>
                <div class="ticket-box" data-overlay-id="overlay-<?php echo $ticket['id'] ?>">
                    <h2><?php echo htmlentities($ticket['title']) ?></h2>
                    <p><?php echo htmlentities($ticket['description']) ?></p>
                </div>
                
                <div id="overlay-<?php echo $ticket['id'] ?>" class="overlay">
                    <div class="overlay-content">
                        <h2><?php echo htmlentities($ticket['title']) ?></h2>
                        <p><?php echo htmlentities($ticket['description']) ?></p>
                        <p>Priority: <?php echo htmlentities($ticket['priority']) ?></p>
                        <p>Status ID: <?php echo htmlentities(get_status_name_by_id($ticket['status_id'])) ?></p>
                        <p>Created by: <?php echo htmlentities(get_username_by_id($ticket['created_by'])) ?></p>
                        <p>Department: <?php echo htmlentities(get_department_by_id($ticket['department_id'])) ?></p>
                    </div>
                </div>
        <?php
            }
        ?>   

*/
