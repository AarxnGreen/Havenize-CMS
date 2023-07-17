# Havenize-CMS
Basic CMS utilizing jQuery, Bootstrap and procedural PHP. Not intended to used as a real web-app and is instead a proof-of-concept hobby project to test functionality and feature integration. Does NOT use prepared statements.

Features:

- CRUD for Users, Posts, Comments and Categories in Admin page.
- Login functionality using MYSQL tables and sessions.
- Registration page for non-admins to create an account.
- Contact form to send emails to support (requires remote routing).
- Graph in Admin page utilizing Google Charts API to track Users, Admins, Published/Draft posts, Approved/Unapproved comments etc.
- Category navbar to sort posts by category.
- Search bar to search via post tags.
- Pagination to limit # of posts per page.
- Track active # of unique users.
- Bulk options for Posts to change multiple settings at once (Publish, Draft, Delete, Clone).
