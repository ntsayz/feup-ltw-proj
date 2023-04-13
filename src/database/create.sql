
PRAGMA foreign_keys = ON;
.mode columns
.headers on
.nullvalue NULL

BEGIN TRANSACTION;


DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT,
    password CHAR(256) NOT NULL,
    full_name TEXT,
    email TEXT NOT NULL UNIQUE,
    user_type TEXT CHECK(user_type IN ('admin', 'agent', 'client'))
);

DROP TABLE IF EXISTS departments;

CREATE TABLE departments (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL
);

DROP TABLE IF EXISTS agent_department;

CREATE TABLE agent_department (
    agent_id INTEGER REFERENCES users(id),
    department_id INTEGER REFERENCES departments(id),
    PRIMARY KEY(agent_id, department_id)
);

DROP TABLE IF EXISTS status;

CREATE TABLE status (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL
);

DROP TABLE IF EXISTS tickets;

CREATE TABLE tickets (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT NOT NULL,
    priority INTEGER CHECK(priority BETWEEN 1 AND 5),
    status_id INTEGER REFERENCES status(id) ON DELETE CASCADE,
    created_by INTEGER REFERENCES users(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    department_id INTEGER NOT NULL REFERENCES departments(id) ON DELETE CASCADE
);

DROP TABLE IF EXISTS hashtags;

CREATE TABLE hashtags (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL
);

DROP TABLE IF EXISTS ticket_hashtag;

CREATE TABLE ticket_hashtag (
    ticket_id INTEGER REFERENCES tickets(id),
    hashtags_id INTEGER REFERENCES hashtags(id),
    PRIMARY KEY(ticket_id, hashtags_id)
);

DROP TABLE IF EXISTS ticket_status;

CREATE TABLE ticket_status (
    ticket_id INTEGER REFERENCES tickets(id),
    status_id INTEGER REFERENCES status(id),
    PRIMARY KEY(ticket_id, status_id)
);

DROP TABLE IF EXISTS faqs;

CREATE TABLE faqs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS ticket_faq;

CREATE TABLE ticket_faq (
    ticket_id INTEGER REFERENCES tickets(id),
    faq_id INTEGER REFERENCES faqs(id),
    PRIMARY KEY(ticket_id, faq_id)
);

DROP TABLE IF EXISTS messages;

CREATE TABLE messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    ticket_id INTEGER REFERENCES tickets(id),
    author_id INTEGER REFERENCES users(id),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    faq_answer INTEGER REFERENCES faqs(id)
);

DROP TABLE IF EXISTS ticket_records;

CREATE TABLE ticket_records (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    action TEXT NOT NULL,
    changed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ticket_id INTEGER REFERENCES tickets(id),
    author_id INTEGER REFERENCES users(id)
);
