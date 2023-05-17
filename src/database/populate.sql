



INSERT INTO users (username, password, full_name, email, user_type)
VALUES ('john_doe', 'password123', 'John Doe', 'john.doe@example.com', 'admin'),
('jane_smith', 'password456', 'Jane Smith', 'jane.smith@example.com', 'agent'),
('mark_johnson', 'password789', 'Mark Johnson', 'mark.johnson@example.com', 'client');

INSERT INTO departments (name)
VALUES ('Sales'), ('Support'), ('Marketing');

INSERT INTO agent_department (agent_id, department_id)
VALUES (2, 1), (2, 2), (3, 1), (3, 3);

INSERT INTO status (name)
VALUES ('Open'), ('In Progress'), ('Resolved');

INSERT INTO tickets (title, description, priority, status_id, created_by, assigned_to, department_id)
VALUES ('Issue with payment', 'I am unable to make a payment on the website.', 3, 1, 3, 2, 1),
('Product inquiry', 'I have a question about your latest product.', 2, 1, 1, 3, 3),
('Login trouble', 'I cannot log in to my account.', 1, 2, 2, 2, 2);

INSERT INTO hashtags (name)
VALUES ('billing'), ('website'), ('product');

INSERT INTO ticket_hashtag (ticket_id, hashtags_id)
VALUES (1, 1), (1, 2), (2, 3), (3, 2);

INSERT INTO ticket_status (ticket_id, status_id)
VALUES (1, 1), (1, 2), (2, 1), (3, 1);

INSERT INTO ticket_tracking (ticket_id, user_id)
VALUES (1, 2), (1, 3), (2, 1), (3, 2);

INSERT INTO faqs (question, answer)
VALUES ('How do I update my billing information?', 'To update your billing information, go to the "Billing" section in your account settings.'),
('What is the return policy?', 'Our return policy allows for returns within 30 days of purchase.');

INSERT INTO ticket_faq (ticket_id, faq_id)
VALUES (1, 1), (2, 2);

INSERT INTO messages (ticket_id, author_id, message, faq_answer)
VALUES (1, 1, 'Thank you for reaching out. We will investigate the issue and get back to you.', NULL),
(1, 2, 'Please provide us with your account details so we can assist you further.', NULL),
(1, 3, 'I have updated my billing information, but the payment still fails.', NULL),
(2, 3, 'Could you provide more information about the product you are interested in?', NULL),
(3, 2, 'I apologize for the inconvenience. Let me assist you with logging in to your account.', NULL),
(3, 1, 'I have successfully logged in to my account. Thank you!', NULL);

INSERT INTO ticket_records (action, ticket_id, author_id)
VALUES ('Ticket created', 1, 3),
('Status changed to In Progress', 1, 2),
('Status changed to Resolved', 1, 2),
('Ticket created', 2, 1),
('Ticket created', 3, 2);


COMMIT;


--action = "STATUS CHANGED: $prev status TO $curr status"
--action = "Sagent name ASSIGNED $assigned agent name"
--action = "$username edited $prev description TO $curr description