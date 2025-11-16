# # Security Features of My CRUD Project

## 1. Sessions
- PHP sessions are used to keep track of logged-in users.
- Every protected page checks if a session exists.
- If no session, the user is redirected to the login page.
- Session ID is regenerated after login to prevent session fixation attacks.

## 2. Cookies
- Optional "Remember Me" feature uses cookies.
- Cookies store the username securely and are verified before granting access.
- Cookies are deleted when the user logs out.

## 3. Authentication Security
- Passwords are stored using PHP's password_hash() function.
- Login uses password_verify() to check passwords.
- All database queries use prepared statements to prevent SQL injection.
- User inputs are sanitized and validated before processing.

