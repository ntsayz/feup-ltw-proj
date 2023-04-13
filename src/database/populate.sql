---USERS

INSERT INTO users (username, password, full_name, email, user_type)
VALUES ('johndoe', 'password123', 'John Doe', 'johndoe@example.com', 'client');

INSERT INTO users (username, password, full_name, email, user_type)
VALUES ('janedoe', 'mypassword', 'Jane Doe', 'janedoe@example.com', 'client');

INSERT INTO users (username, password, full_name, email, user_type)
VALUES ('adminuser', 'adminpassword', 'Admin User', 'admin@example.com', 'admin');

INSERT INTO users (username, password, full_name, email, user_type)
VALUES ('agentuser', 'agentpassword', 'Agent User', 'agent@example.com', 'agent');




INSERT INTO departments (name)
VALUES ('Sales');

INSERT INTO departments (name)
VALUES ('Support');

INSERT INTO departments (name)
VALUES ('Technical');




INSERT INTO agent_department (agent_id, department_id)
VALUES (4, 2);

INSERT INTO agent_department (agent_id, department_id)
VALUES (4, 3);




INSERT INTO status (name)
VALUES ('Open');

INSERT INTO status (name)
VALUES ('In Progress');

INSERT INTO status (name)
VALUES ('Closed');





INSERT INTO tickets (title, description, priority, status_id, created_by, department_id)
VALUES ('Server down', 'Our server is currently down, please investigate', 1, 1, 2, 3);

INSERT INTO tickets (title, description, priority, status_id, created_by, department_id)
VALUES ('Billing issue', 'I have been overcharged on my bill, please assist', 2, 1, 1, 1);




INSERT INTO hashtags (name)
VALUES ('server');

INSERT INTO hashtags (name)
VALUES ('billing');

INSERT INTO hashtags (name)
VALUES ('technical');





INSERT INTO ticket_hashtag (ticket_id, hashtags_id)
VALUES (1, 1);

INSERT INTO ticket_hashtag (ticket_id, hashtags_id)
VALUES (2, 2);

INSERT INTO ticket_hashtag (ticket_id, hashtags_id)
VALUES (2, 3);




INSERT INTO faqs (question, answer)
VALUES ('How do I reset my password?', 'You can reset your password by clicking on the "Forgot Password" link on the login page and following the instructions.');

INSERT INTO faqs (question, answer)
VALUES ('What are your business hours?', 'Our business hours are from 9am to 5pm, Monday to Friday.');


INSERT INTO ticket_faq (ticket_id, faq_id)
VALUES (1, 1);

INSERT INTO ticket_faq (ticket_id, faq_id)
VALUES (2, 2);




INSERT INTO messages (ticket_id, author_id, message)
VALUES (1, 2, 'I have checked the server and identified the issue. We are working to fix it as soon as possible.');

INSERT INTO messages (ticket_id, author_id, message)
VALUES (2, 2, 'How should I fix this?');





